<?php

namespace Goldcrab\Delma\EquineBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Goldcrab\Delma\EquineBundle\Entity\CytologyPFATest;
use Goldcrab\Delma\EquineBundle\Form\CytologyPFATestType;

/**
 * CytologyPFATest controller.
 *
 * @Route("/test/cytology/pfa")
 */
class CytologyPFATestController extends TestController
{

    function __construct()
    {
        $this->repositoryName = 'DelmaEquineBundle:CytologyPFATest';
        $this->pdfOrientation = 'P';
    }


    /**
     * Lists all CytologyPFATest entities.
     *
     * @Route("/", name="test_cytology_pfa")
     * @Method("GET")
     * @Template()
     */
    public function indexAction( Request $request)
    {
        return parent::indexAction($request);
    }

    /**
     * Creates a new CytologyPFATest entity.
     *
     * @Route("/", name="test_cytology_pfa_create")
     * @Method("POST")
     * @Template("DelmaEquineBundle:CytologyPFATest:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity  = new CytologyPFATest();
        $form = $this->createForm(new CytologyPFATestType($this->getDoctrine()->getManager()), $entity);
        $form->submit($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('test_cytology_pfa_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Displays a form to create a new CytologyPFATest entity.
     *
     * @Route("/new", name="test_cytology_pfa_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new CytologyPFATest();

        //Populate Form Default values
        $entity->setTestedDate(new \DateTime());
        $entity->setSampleDate(new \DateTime());

        $user = $this->get('security.context')->getToken()->getUser();
        if($user->getType()=='Lab'){
            $entity->setTestedBy($user);
        }


        $form   = $this->createForm(new CytologyPFATestType($this->getDoctrine()->getManager()), $entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a CytologyPFATest entity.
     *
     * @Route("/{id}", name="test_cytology_pfa_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('DelmaEquineBundle:CytologyPFATest')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find CytologyPFATest entity.');
        }

        return array(
            'entity'      => $entity
        );
    }

    /**
     * Displays a form to edit an existing CytologyPFATest entity.
     *
     * @Route("/{id}/edit", name="test_cytology_pfa_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('DelmaEquineBundle:CytologyPFATest')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find CytologyPFATest entity.');
        }

        $editForm = $this->createForm(new CytologyPFATestType($this->getDoctrine()->getManager()), $entity);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView()
        );
    }

    /**
     * Edits an existing CytologyPFATest entity.
     *
     * @Route("/{id}", name="test_cytology_pfa_update")
     * @Method("PUT")
     * @Template("DelmaEquineBundle:CytologyPFATest:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('DelmaEquineBundle:CytologyPFATest')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find CytologyPFATest entity.');
        }

        $editForm = $this->createForm(new CytologyPFATestType($this->getDoctrine()->getManager()), $entity);
        $editForm->submit($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('test_cytology_pfa_show', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView()
        );
    }

    /**
     * Finds and displays a CytologyPFATest entity.
     *
     * @Route("/{id}/print", name="test_cytology_pfa_print")
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
     * @Route("/email", name="test_cytology_pfa_email")
     * @Method("POST")
     * @Template()
     */
    public function emailAction( Request $request )
    {
        $emailTestID = $this->sendTestEmail($request);
        return $this->redirect($this->generateUrl('test_cytology_pfa_show', array('id' => $emailTestID)));
    }

    /**
     * Deletes a  entity.
     *
     * @Route("/{id}/delete", name="test_cytology_pfa_delete")
     * @Method("GET")
     */
    public function deleteAction($id)
    {
        $this->deleteEntity($id);
        return $this->redirect($this->generateUrl('test_cytology_pfa'));
    }

    /**
     * Displays multiple test for printing.
     *
     * @Route("/delete/multiple", name="test_cytology_pfa_delete_multiple")
     * @Method("POST")
     * @Template()
     */
    public function deleteMultipleAction( Request $request)
    {
        $this->deleteEntries($request);
        return $this->redirect($this->generateUrl('test_cytology_pfa'));

    }

}
