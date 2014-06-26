<?php

namespace Goldcrab\Delma\EquineBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Goldcrab\Delma\EquineBundle\Entity\Antibiotic;
use Goldcrab\Delma\EquineBundle\Form\AntibioticType;

/**
 * Antibiotic controller.
 *
 * @Route("/antibiotic")
 */
class AntibioticController extends Controller
{

    /**
     * Lists all Antibiotic entities.
     *
     * @Route("/", name="antibiotic")
     * @Method("GET")
     * @Template()
     */
    public function indexAction( Request $request )
    {
        $em = $this->getDoctrine()->getManager();
        $repository = $em->getRepository('DelmaEquineBundle:Antibiotic');
        $queryBuilder = $repository->createQueryBuilder('a')
            ->select('a')
            ->andWhere(' 1=1 ');
        $queryBuilder->addOrderBy('a.order','ASC');
        $filterForm = $this->getFilterForm();
        $filterForm->handleRequest($request);
        if ($filterForm->get('filter')->isClicked()) {
            $filterData = $filterForm->getData();
            if(!is_null($filterData['searchText'])){
                $searchText = $filterForm->get('searchText')->getData();
                $queryBuilder->andWhere(" a.name LIKE :name OR a.code LIKE :name1 ");
                $queryBuilder->setParameter('name','%'. $searchText .'%');
                $queryBuilder->setParameter('name1','%'. $searchText .'%');
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
     * Creates a new Antibiotic entity.
     *
     * @Route("/", name="antibiotic_create")
     * @Method("POST")
     * @Template("DelmaEquineBundle:Antibiotic:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Antibiotic();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('antibiotic_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
    * Creates a form to create a Antibiotic entity.
    *
    * @param Antibiotic $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(Antibiotic $entity)
    {
        $form = $this->createForm(new AntibioticType(), $entity, array(
            'action' => $this->generateUrl('antibiotic_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Antibiotic entity.
     *
     * @Route("/new", name="antibiotic_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Antibiotic();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Antibiotic entity.
     *
     * @Route("/{id}", name="antibiotic_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('DelmaEquineBundle:Antibiotic')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Antibiotic entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Antibiotic entity.
     *
     * @Route("/{id}/edit", name="antibiotic_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('DelmaEquineBundle:Antibiotic')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Antibiotic entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
    * Creates a form to edit a Antibiotic entity.
    *
    * @param Antibiotic $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Antibiotic $entity)
    {
        $form = $this->createForm(new AntibioticType(), $entity, array(
            'action' => $this->generateUrl('antibiotic_show', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Antibiotic entity.
     *
     * @Route("/{id}", name="antibiotic_update")
     * @Method("PUT")
     * @Template("DelmaEquineBundle:Antibiotic:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('DelmaEquineBundle:Antibiotic')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Antibiotic entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('antibiotic_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Antibiotic entity.
     *
     * @Route("/{id}", name="antibiotic_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('DelmaEquineBundle:Antibiotic')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Antibiotic entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('antibiotic'));
    }

    /**
     * Creates a form to delete a Antibiotic entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('antibiotic_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
