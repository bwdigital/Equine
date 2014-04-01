<?php

namespace Goldcrab\Delma\EquineBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Goldcrab\Delma\EquineBundle\Entity\CytologyJFATest;
use Goldcrab\Delma\EquineBundle\Form\CytologyJFATestType;

/**
 * CytologyJFATest controller.
 *
 * @Route("/test/cytology/jfa")
 */
class CytologyJFATestController extends TestController
{

    function __construct()
    {
        $this->repositoryName = 'DelmaEquineBundle:CytologyJFATest';
        $this->pdfOrientation = 'P';
    }


    /**
     * Lists all CytologyJFATest entities.
     *
     * @Route("/", name="test_cytology_jfa")
     * @Method("GET")
     * @Template()
     */
    public function indexAction( Request $request)
    {
        return parent::indexAction($request);
    }

    /**
     * Creates a new CytologyJFATest entity.
     *
     * @Route("/", name="test_cytology_jfa_create")
     * @Method("POST")
     * @Template("DelmaEquineBundle:CytologyJFATest:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity  = new CytologyJFATest();
        $form = $this->createForm(new CytologyJFATestType($this->getDoctrine()->getManager()), $entity);
        $form->submit($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('test_cytology_jfa_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Displays a form to create a new CytologyJFATest entity.
     *
     * @Route("/new", name="test_cytology_jfa_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new CytologyJFATest();

        //Populate Form Default values
        $entity->setTestedDate(new \DateTime());
        $entity->setSampleDate(new \DateTime());

        $user = $this->get('security.context')->getToken()->getUser();
        if($user->getType()=='Lab'){
            $entity->setTestedBy($user);
        }

        $form   = $this->createForm(new CytologyJFATestType($this->getDoctrine()->getManager()), $entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a CytologyJFATest entity.
     *
     * @Route("/{id}", name="test_cytology_jfa_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('DelmaEquineBundle:CytologyJFATest')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find CytologyJFATest entity.');
        }

        return array(
            'entity'      => $entity
        );
    }

    /**
     * Displays a form to edit an existing CytologyJFATest entity.
     *
     * @Route("/{id}/edit", name="test_cytology_jfa_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('DelmaEquineBundle:CytologyJFATest')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find CytologyJFATest entity.');
        }

        $editForm = $this->createForm(new CytologyJFATestType($this->getDoctrine()->getManager()), $entity);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView()
        );
    }

    /**
     * Edits an existing CytologyJFATest entity.
     *
     * @Route("/{id}", name="test_cytology_jfa_update")
     * @Method("PUT")
     * @Template("DelmaEquineBundle:CytologyJFATest:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('DelmaEquineBundle:CytologyJFATest')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find CytologyJFATest entity.');
        }

        $editForm = $this->createForm(new CytologyJFATestType($this->getDoctrine()->getManager()), $entity);
        $editForm->submit($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('test_cytology_jfa_show', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView()
        );
    }

    /**
     * Finds and displays a CytologyJFATest entity.
     *
     * @Route("/{id}/print", name="test_cytology_jfa_print")
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
     * @Route("/email", name="test_cytology_jfa_email")
     * @Method("POST")
     * @Template()
     */
    public function emailAction( Request $request )
    {
        $emailTestID = $this->sendTestEmail($request);
        return $this->redirect($this->generateUrl('test_cytology_jfa_show', array('id' => $emailTestID)));
    }

    /**
     * Deletes a  entity.
     *
     * @Route("/{id}/delete", name="test_cytology_jfa_delete")
     * @Method("GET")
     */
    public function deleteAction($id)
    {
        $this->deleteEntity($id);
        return $this->redirect($this->generateUrl('test_cytology_jfa'));
    }

    /**
     * Displays multiple test for printing.
     *
     * @Route("/delete/multiple", name="test_cytology_jfa_delete_multiple")
     * @Method("POST")
     * @Template()
     */
    public function deleteMultipleAction( Request $request)
    {
        $this->deleteEntries($request);
        return $this->redirect($this->generateUrl('test_cytology_jfa'));

    }
}
