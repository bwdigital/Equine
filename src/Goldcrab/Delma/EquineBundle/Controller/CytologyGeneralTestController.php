<?php

namespace Goldcrab\Delma\EquineBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Goldcrab\Delma\EquineBundle\Entity\CytologyGeneralTest;
use Goldcrab\Delma\EquineBundle\Form\CytologyGeneralTestType;

/**
 * CytologyGeneralTest controller.
 *
 * @Route("/test/cytology/general")
 */
class CytologyGeneralTestController extends TestController
{

    function __construct()
    {
        $this->repositoryName = 'DelmaEquineBundle:CytologyGeneralTest';
        $this->pdfOrientation = 'P';
    }


    /**
     * Lists all CytologyGeneralTest entities.
     *
     * @Route("/", name="test_cytology_general")
     * @Method("GET")
     * @Template()
     */
    public function indexAction( Request $request)
    {
        return parent::indexAction($request);
    }

    /**
     * Creates a new CytologyGeneralTest entity.
     *
     * @Route("/", name="test_cytology_general_create")
     * @Method("POST")
     * @Template("DelmaEquineBundle:CytologyGeneralTest:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity  = new CytologyGeneralTest();
        $form = $this->createForm(new CytologyGeneralTestType($this->getDoctrine()->getManager()), $entity);
        $form->submit($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('test_cytology_general_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Displays a form to create a new CytologyGeneralTest entity.
     *
     * @Route("/new", name="test_cytology_general_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new CytologyGeneralTest();

        //Populate Form Default values
        $entity->setTestedDate(new \DateTime());
        $user = $this->get('security.context')->getToken()->getUser();
        if($user->getType()=='Lab'){
            $entity->setTestedBy($user);
        }


        $form   = $this->createForm(new CytologyGeneralTestType($this->getDoctrine()->getManager()), $entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a CytologyGeneralTest entity.
     *
     * @Route("/{id}", name="test_cytology_general_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('DelmaEquineBundle:CytologyGeneralTest')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find CytologyGeneralTest entity.');
        }

        return array(
            'entity'      => $entity
        );
    }

    /**
     * Displays a form to edit an existing CytologyGeneralTest entity.
     *
     * @Route("/{id}/edit", name="test_cytology_general_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('DelmaEquineBundle:CytologyGeneralTest')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find CytologyGeneralTest entity.');
        }

        $editForm = $this->createForm(new CytologyGeneralTestType($this->getDoctrine()->getManager()), $entity);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView()
        );
    }

    /**
     * Edits an existing CytologyGeneralTest entity.
     *
     * @Route("/{id}", name="test_cytology_general_update")
     * @Method("PUT")
     * @Template("DelmaEquineBundle:CytologyGeneralTest:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('DelmaEquineBundle:CytologyGeneralTest')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find CytologyGeneralTest entity.');
        }

        $editForm = $this->createForm(new CytologyGeneralTestType($this->getDoctrine()->getManager()), $entity);
        $editForm->submit($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('test_cytology_general_show', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView()
        );
    }

    /**
     * Finds and displays a CytologyGeneralTest entity.
     *
     * @Route("/{id}/print", name="test_cytology_general_print")
     * @Method("GET")
     * @Template()
     */
    public function printAction($id)
    {
        return parent::printAction($id);
    }

    /**
     * Finds and displays a BloodTest entity.
     *
     * @Route("/email", name="test_cytology_general_email")
     * @Method("POST")
     * @Template()
     */
    public function emailAction( Request $request )
    {
        $emailTestID = $this->sendTestEmail($request);
        return $this->redirect($this->generateUrl('test_cytology_general_show', array('id' => $emailTestID)));
    }

    /**
     * Deletes a  entity.
     *
     * @Route("/{id}/delete", name="test_cytology_general_delete")
     * @Method("GET")
     */
    public function deleteAction($id)
    {
        $this->deleteEntity($id);
        return $this->redirect($this->generateUrl('test_cytology_general'));
    }

    /**
     * Displays multiple test for printing.
     *
     * @Route("/delete/multiple", name="test_cytology_general_delete_multiple")
     * @Method("POST")
     * @Template()
     */
    public function deleteMultipleAction( Request $request)
    {
        $this->deleteEntries($request);
        return $this->redirect($this->generateUrl('test_cytology_general'));

    }

}
