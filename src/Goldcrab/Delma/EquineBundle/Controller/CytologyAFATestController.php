<?php

namespace Goldcrab\Delma\EquineBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Goldcrab\Delma\EquineBundle\Entity\CytologyAFATest;
use Goldcrab\Delma\EquineBundle\Form\CytologyAFATestType;

/**
 * CytologyAFATest controller.
 *
 * @Route("/test/cytology/afa")
 */
class CytologyAFATestController extends TestController
{

    function __construct()
    {
        $this->repositoryName = 'DelmaEquineBundle:CytologyAFATest';
        $this->pdfOrientation = 'P';
    }

    /**
     * Lists all CytologyAFATest entities.
     *
     * @Route("/", name="test_cytology_afa")
     * @Method("GET")
     * @Template()
     */
    public function indexAction( Request $request)
    {
        return parent::indexAction($request);
    }

    /**
     * Creates a new CytologyAFATest entity.
     *
     * @Route("/", name="test_cytology_afa_create")
     * @Method("POST")
     * @Template("DelmaEquineBundle:CytologyAFATest:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity  = new CytologyAFATest();
        $form = $this->createForm(new CytologyAFATestType($this->getDoctrine()->getManager()), $entity);
        $form->submit($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('test_cytology_afa_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Displays a form to create a new CytologyAFATest entity.
     *
     * @Route("/new", name="test_cytology_afa_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new CytologyAFATest();

        //Populate Form Default values
        $entity->setTestedDate(new \DateTime());
        $entity->setSampleDate(new \DateTime());
        $user = $this->get('security.context')->getToken()->getUser();
        if($user->getType()=='Lab'){
            $entity->setTestedBy($user);
        }


        $form   = $this->createForm(new CytologyAFATestType($this->getDoctrine()->getManager()), $entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a CytologyAFATest entity.
     *
     * @Route("/{id}", name="test_cytology_afa_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('DelmaEquineBundle:CytologyAFATest')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find CytologyAFATest entity.');
        }

        return array(
            'entity'      => $entity
        );
    }

    /**
     * Displays a form to edit an existing CytologyAFATest entity.
     *
     * @Route("/{id}/edit", name="test_cytology_afa_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('DelmaEquineBundle:CytologyAFATest')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find CytologyAFATest entity.');
        }

        $editForm = $this->createForm(new CytologyAFATestType($this->getDoctrine()->getManager()), $entity);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView()
        );
    }

    /**
     * Edits an existing CytologyAFATest entity.
     *
     * @Route("/{id}", name="test_cytology_afa_update")
     * @Method("PUT")
     * @Template("DelmaEquineBundle:CytologyAFATest:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('DelmaEquineBundle:CytologyAFATest')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find CytologyAFATest entity.');
        }

        $editForm = $this->createForm(new CytologyAFATestType($this->getDoctrine()->getManager()), $entity);
        $editForm->submit($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('test_cytology_afa_show', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView()
        );
    }


    /**
     * Finds and displays a CytologyAFATest entity.
     *
     * @Route("/{id}/print", name="test_cytology_afa_print")
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
     * @Route("/email", name="test_cytology_afa_email")
     * @Method("POST")
     * @Template()
     */
    public function emailAction( Request $request )
    {
        $emailTestID = $this->sendTestEmail($request);
        return $this->redirect($this->generateUrl('test_cytology_afa_show', array('id' => $emailTestID)));
    }

    /**
     * Deletes a  entity.
     *
     * @Route("/{id}/delete", name="test_cytology_afa_delete")
     * @Method("GET")
     */
    public function deleteAction($id)
    {
        $this->deleteEntity($id);
        return $this->redirect($this->generateUrl('test_cytology_afa'));
    }

    /**
     * Displays multiple test for printing.
     *
     * @Route("/delete/multiple", name="test_cytology_afa_delete_multiple")
     * @Method("POST")
     * @Template()
     */
    public function deleteMultipleAction( Request $request)
    {
        $this->deleteEntries($request);
        return $this->redirect($this->generateUrl('test_cytology_afa'));

    }

}