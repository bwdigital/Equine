<?php

namespace Goldcrab\Delma\EquineBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Goldcrab\Delma\EquineBundle\Entity\Horse;
use Goldcrab\Delma\EquineBundle\Form\HorseType;
use Doctrine\DBAL\Query\QueryBuilder;

/**
 * Horse controller.
 *
 * @Route("/horse")
 */
class HorseController extends Controller
{

    /**
     * Lists all Horse entities.
     *
     * @Route("/", name="horse")
     * @Method("GET")
     * @Template()
     */
    public function indexAction( Request $request )
    {
        $em = $this->getDoctrine()->getManager();
        $repository = $em->getRepository('DelmaEquineBundle:Horse');
        $queryBuilder = $repository->createQueryBuilder('h')
            ->select(array('h','s'))
            ->leftJoin('h.stable', 's')
            ->andWhere(' 1=1 ');

        $filterForm = $this->getFilterForm();
        $filterForm->handleRequest($request);
        if ($filterForm->get('filter')->isClicked()) {
            $filterData = $filterForm->getData();
            if(!is_null($filterData['searchText'])){
                $searchText = $filterForm->get('searchText')->getData();
                $queryBuilder->andWhere(" h.name LIKE :name1 OR h.alternateName LIKE :name2  OR  h.sire LIKE :name3 OR h.dam LIKE :name4 ");
                $queryBuilder->setParameter('name1','%'. $searchText .'%');
                $queryBuilder->setParameter('name2','%'. $searchText .'%');
                $queryBuilder->setParameter('name3','%'. $searchText .'%');
                $queryBuilder->setParameter('name4','%'. $searchText .'%');
            }
            if(!$filterForm->get('stable')->isEmpty()){
                $stable = $filterForm->get('stable')->getData();
                $queryBuilder->andWhere(" s.id = :stableId ");
                $queryBuilder->setParameter('stableId', $stable->getId());
            }
        }
        $paginator  = $this->get('knp_paginator');
        $query = $queryBuilder->getQuery();
        $pagination = $paginator->paginate( $query ,$this->get('request')->query->get('page', 1),20);

        $entities = $query->getResult();

        return array(
            'entities' => $entities,
            'pagination' => $pagination,
            'filterForm' => $filterForm->createView()
        );
    }



    /**
     * @return Form|Form
     */
    function getFilterForm(){
        $builder = $this->createFormBuilder();

        $builder->add(
            'searchText', 'text',array(
            'attr' => array(
                'style' => "width:300px;"
            ),
            'required' => false,
            'label' => 'Name'
        ));

        $builder->add('stable', 'genemu_jqueryselect2_entity', array(
            'attr' => array(
                'style' => "width:80%",
            ),
            'class' => 'DelmaEquineBundle:Stable',
            'property' => 'name',
            'required' => false,
            'empty_value' => '',
            'label' => 'Stable'
        ));

        $builder->add('filter', 'submit', array(
            'attr' => array('class' => 'filter'),
        ));

        $builder->setMethod('GET');

        return $builder->getForm();
    }

    /**
     * List Horse entities in Json.
     *
     * @Route("/list/json", name="horse_list_json")
     * @Method("GET")
     * @Template()
     */
    public function jsonListAction(Request $request){

        $em = $this->getDoctrine()->getManager();
        $repository = $em->getRepository('DelmaEquineBundle:Horse');

        /*
         * @var $queryBuilder \Doctrine\DBAL\Query\QueryBuilder
         */
        $queryBuilder = $repository->createQueryBuilder('h')
            ->select('h.id,h.name,h.alternateName')
            ->add('orderBy', 'h.name ASC')
            ->setMaxResults(100);


        if ($request->query->has('q')) {
            $searchString = $request->query->get('q');

            $queryBuilder->andWhere(" h.name LIKE :query1 OR h.alternateName LIKE :query2 " );
            $queryBuilder->setParameter('query1', '%'.$searchString.'%');
            $queryBuilder->setParameter('query2', '%'.$searchString.'%');
        }

        $result = $queryBuilder->getQuery()->getArrayResult();
        $totalCount = $queryBuilder->select('COUNT(h)')->getQuery()->getSingleScalarResult();

        $return = array(
            'count' => $totalCount,
            'horses' => $result
        );

        $serializer = $this->container->get('serializer');
        $serializedReturn = $serializer->serialize($return, 'json');
        if($request->query->has('callback')){
            $callback = $request->query->get('callback');
            $serializedReturn = $callback . '(' . $serializedReturn . ')';
        }
        return new Response($serializedReturn, 200, array('Content-Type' => 'application/json'));
    }

    /**
     * Finds and displays a Horse entity in Json.
     *
     * @Route("/{id}/json", name="horse_json")
     * @Method("GET")
     * @Template()
     */
    public function jsonDetailAction(Request $request,$id){
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('DelmaEquineBundle:Horse')->find($id);

        if (!$entity) {
            $entity = array();
        }

        $serializer = $this->container->get('serializer');
        $serializedEntity = $serializer->serialize($entity, 'json');

        if($request->query->has('callback')){
            $callback = $request->query->get('callback');
            $serializedEntity = $callback . '(' . $serializedEntity . ')';
        }

        return new Response($serializedEntity, 200, array('Content-Type' => 'application/json'));
    }

    /**
     * Creates a new Horse entity.
     *
     * @Route("/", name="horse_create")
     * @Method("POST")
     * @Template("DelmaEquineBundle:Horse:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity  = new Horse();
        $form = $this->createForm(new HorseType($this->getDoctrine()->getManager()), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            if($request->get('submitButton')=='Save & New'){
                return $this->redirect($this->generateUrl('horse_new',array('_msg'=>'Horse created successfully!')));
                exit();
            }

            return $this->redirect($this->generateUrl('horse_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Displays a form to create a new Horse entity.
     *
     * @Route("/new", name="horse_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Horse();
        $form   = $this->createForm(new HorseType($this->getDoctrine()->getManager()), $entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Horse entity.
     *
     * @Route("/{id}", name="horse_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('DelmaEquineBundle:Horse')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Horse entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Horse entity.
     *
     * @Route("/{id}/edit", name="horse_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('DelmaEquineBundle:Horse')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Horse entity.');
        }

        $editForm = $this->createForm(new HorseType($this->getDoctrine()->getManager()), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing Horse entity.
     *
     * @Route("/{id}", name="horse_update")
     * @Method("PUT")
     * @Template("DelmaEquineBundle:Horse:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('DelmaEquineBundle:Horse')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Horse entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new HorseType($this->getDoctrine()->getManager()), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('horse_show', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Horse entity.
     *
     * @Route("/{id}", name="horse_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('DelmaEquineBundle:Horse')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Horse entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('horse'));
    }

    /**
     * Creates a form to delete a Horse entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
