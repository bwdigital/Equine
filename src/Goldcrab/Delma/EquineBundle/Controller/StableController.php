<?php

namespace Goldcrab\Delma\EquineBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Goldcrab\Delma\EquineBundle\Entity\Stable;
use Goldcrab\Delma\EquineBundle\Form\StableType;

/**
 * Stable controller.
 *
 * @Route("/stable")
 */
class StableController extends Controller
{

    /**
     * Lists all Stable entities.
     *
     * @Route("/", name="stable")
     * @Method("GET")
     * @Template()
     */
    public function indexAction(Request $request)
    {

        $em = $this->getDoctrine()->getManager();
        $repository = $em->getRepository('DelmaEquineBundle:Stable');
        $queryBuilder = $repository->createQueryBuilder('s')
            ->select('s')
            ->andWhere(' 1=1 ');

        $filterForm = $this->getFilterForm();
        $filterForm->handleRequest($request);
        if ($filterForm->get('filter')->isClicked()) {
            $filterData = $filterForm->getData();
            if(!is_null($filterData['searchText'])){
                $searchText = $filterForm->get('searchText')->getData();
                $queryBuilder->andWhere(" s.name LIKE :name ");
                $queryBuilder->setParameter('name','%'. $searchText .'%');
            }
        }

        $paginator  = $this->get('knp_paginator');
        $query = $queryBuilder->getQuery();
        $pagination = $paginator->paginate( $query ,$this->get('request')->query->get('page', 1),10);

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
                'style' => "width:80%"
            ),
            'required' => false,
            'label' => 'Name'
        ));

        $builder->add('filter', 'submit', array(
            'attr' => array('class' => 'filter'),
        ));

        $builder->setMethod('GET');

        return $builder->getForm();
    }


    /**
     * Creates a new Stable entity.
     *
     * @Route("/", name="stable_create")
     * @Method("POST")
     * @Template("DelmaEquineBundle:Stable:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity  = new Stable();
        $form = $this->createForm(new StableType($this->getDoctrine()->getManager()), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('stable_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Displays a form to create a new Stable entity.
     *
     * @Route("/new", name="stable_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Stable();
        $form   = $this->createForm(new StableType($this->getDoctrine()->getManager()), $entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Stable entity.
     *
     * @Route("/{id}", name="stable_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('DelmaEquineBundle:Stable')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Stable entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Stable entity.
     *
     * @Route("/{id}/edit", name="stable_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('DelmaEquineBundle:Stable')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Stable entity.');
        }

        $editForm = $this->createForm(new StableType($this->getDoctrine()->getManager()), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing Stable entity.
     *
     * @Route("/{id}", name="stable_update")
     * @Method("PUT")
     * @Template("DelmaEquineBundle:Stable:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('DelmaEquineBundle:Stable')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Stable entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new StableType($this->getDoctrine()->getManager()), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('stable_show', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Stable entity.
     *
     * @Route("/{id}", name="stable_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('DelmaEquineBundle:Stable')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Stable entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('stable'));
    }

    /**
     * Creates a form to delete a Stable entity by id.
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
