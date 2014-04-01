<?php

namespace Goldcrab\Delma\EquineBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Goldcrab\Delma\EquineBundle\Entity\UrineTest;
use Goldcrab\Delma\EquineBundle\Form\UrineTestType;

/**
 * UrineTest controller.
 *
 * @Route("/test/urine")
 */
class UrineTestController extends TestController
{

    function __construct()
    {
        $this->repositoryName = 'DelmaEquineBundle:UrineTest';
        $this->pdfOrientation = 'P';
    }


    /**
     * Lists all UrineTest entities.
     *
     * @Route("/", name="test_urine")
     * @Method("GET")
     * @Template()
     */
    public function indexAction( Request $request)
    {
        return parent::indexAction($request);
    }

    /**
     * Creates a new UrineTest entity.
     *
     * @Route("/", name="test_urine_create")
     * @Method("POST")
     * @Template("DelmaEquineBundle:UrineTest:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity  = new UrineTest();
        $form = $this->createForm(new UrineTestType($this->getDoctrine()->getManager()), $entity);
        $form->submit($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('test_urine_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Displays a form to create a new UrineTest entity.
     *
     * @Route("/new", name="test_urine_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new UrineTest();

        //Populate Form Default values
        $entity->setTestedDate(new \DateTime());
        /**
         * @var \Goldcrab\Delma\UserBundle\Entity\User $user
         */
        $user = $this->get('security.context')->getToken()->getUser();
        if($user->getType()=='Lab'){
            $entity->setTestedBy($user);
        }

        $form   = $this->createForm(new UrineTestType($this->getDoctrine()->getManager()), $entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a UrineTest entity.
     *
     * @Route("/{id}", name="test_urine_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('DelmaEquineBundle:UrineTest')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find UrineTest entity.');
        }

        return array(
            'entity'      => $entity
        );
    }

    /**
     * Displays a form to edit an existing UrineTest entity.
     *
     * @Route("/{id}/edit", name="test_urine_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('DelmaEquineBundle:UrineTest')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find UrineTest entity.');
        }

        $editForm = $this->createForm(new UrineTestType($this->getDoctrine()->getManager()), $entity);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView()
        );
    }

    /**
     * Edits an existing UrineTest entity.
     *
     * @Route("/{id}", name="test_urine_update")
     * @Method("PUT")
     * @Template("DelmaEquineBundle:UrineTest:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('DelmaEquineBundle:UrineTest')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find UrineTest entity.');
        }

        $editForm = $this->createForm(new UrineTestType($this->getDoctrine()->getManager()), $entity);
        $editForm->submit($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('test_urine_show', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView()
        );
    }

    /**
     * Finds and displays a UrineTest entity.
     *
     * @Route("/{id}/print", name="test_urine_print")
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
     * @Route("/email", name="test_urine_email")
     * @Method("POST")
     * @Template()
     */
    public function emailAction( Request $request )
    {
        $emailTestID = $this->sendTestEmail($request);
        return $this->redirect($this->generateUrl('test_urine_show', array('id' => $emailTestID)));
    }

    /**
     * Deletes a  entity.
     *
     * @Route("/{id}/delete", name="test_urine_delete")
     * @Method("GET")
     */
    public function deleteAction($id)
    {
        $this->deleteEntity($id);
        return $this->redirect($this->generateUrl('test_urine'));
    }

    /**
     * Displays multiple test for printing.
     *
     * @Route("/delete/multiple", name="test_urine_delete_multiple")
     * @Method("POST")
     * @Template()
     */
    public function deleteMultipleAction( Request $request)
    {
        $this->deleteEntries($request);
        return $this->redirect($this->generateUrl('test_urine'));

    }

}
