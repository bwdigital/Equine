<?php

namespace Goldcrab\Delma\EquineBundle\Controller;

use Doctrine\Common\Collections\ArrayCollection;
use Goldcrab\Delma\EquineBundle\Entity\GlucoseEntry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Goldcrab\Delma\EquineBundle\Entity\GlucoseTest;
use Goldcrab\Delma\EquineBundle\Form\GlucoseTestType;

/**
 * GlucoseTest controller.
 *
 * @Route("/test/glucose")
 */
class GlucoseTestController extends TestController
{

    function __construct()
    {
        $this->repositoryName = 'DelmaEquineBundle:GlucoseTest';
        $this->pdfOrientation = 'P';
    }


    /**
     * Lists all GlucoseTest entities.
     *
     * @Route("/", name="test_glucose")
     * @Method("GET")
     * @Template()
     */
    public function indexAction( Request $request)
    {
        return parent::indexAction($request);
    }

    /**
     * Creates a new GlucoseTest entity.
     *
     * @Route("/", name="test_glucose_create")
     * @Method("POST")
     * @Template("DelmaEquineBundle:GlucoseTest:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new GlucoseTest();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            foreach($entity->getTestValues() as $testValue){
                $testValue->setGlucoseTest($entity);
            }
            $em->persist($entity);
            $em->flush();
            return $this->redirect($this->generateUrl('test_glucose_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
    * Creates a form to create a GlucoseTest entity.
    *
    * @param GlucoseTest $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(GlucoseTest $entity)
    {
        $form = $this->createForm(new GlucoseTestType($this->getDoctrine()->getManager()), $entity, array(
            'action' => $this->generateUrl('test_glucose_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new GlucoseTest entity.
     *
     * @Route("/new", name="test_glucose_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new GlucoseTest();

        //Populate Form Default values
        $entity->setTestedDate(new \DateTime());
        $user = $this->get('security.context')->getToken()->getUser();
        if($user->getType()=='Lab'){
            $entity->setTestedBy($user);
        }

        $testValues = new ArrayCollection();
        for($counter = 0; $counter <= 5; $counter++){
            $testValue = new GlucoseEntry();
            $testValue->setTime( 30 * $counter);
            $testValue->setValue( 0.0 );
            $testValues->add($testValue);
        }
        $entity->setTestValues($testValues);

        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a GlucoseTest entity.
     *
     * @Route("/{id}", name="test_glucose_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('DelmaEquineBundle:GlucoseTest')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find GlucoseTest entity.');
        }

        return array(
            'entity'      => $entity
        );
    }

    /**
     * Displays a form to edit an existing GlucoseTest entity.
     *
     * @Route("/{id}/edit", name="test_glucose_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('DelmaEquineBundle:GlucoseTest')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find GlucoseTest entity.');
        }

        $editForm = $this->createEditForm($entity);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView()
        );
    }

    /**
    * Creates a form to edit a GlucoseTest entity.
    *
    * @param GlucoseTest $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(GlucoseTest $entity)
    {
        $form = $this->createForm(new GlucoseTestType($this->getDoctrine()->getManager()), $entity, array(
            'action' => $this->generateUrl('test_glucose_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing GlucoseTest entity.
     *
     * @Route("/{id}", name="test_glucose_update")
     * @Method("PUT")
     * @Template("DelmaEquineBundle:GlucoseTest:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        /**
         * @var GlucoseTest $entity
         * @var GlucoseEntry $testValue
         */
        $entity = $em->getRepository('DelmaEquineBundle:GlucoseTest')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find GlucoseTest entity.');
        }


        $originalTestValues = array();
        foreach ($entity->getTestValues() as $testValue) {
            $originalTestValues[] = $testValue;
        }


        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {

            foreach($entity->getTestValues() as $testValue){
                foreach ($originalTestValues as $key => $toDel) {
                    if ($toDel->getId() === $testValue->getId()) {
                        unset($originalTestValues[$key]);
                    }
                }
            }

            foreach ($originalTestValues as $testValue) {
                $testValue->setGlucoseTest(null);
                $entity->removeTestValue($testValue);
                $em->remove($testValue);
            }

            foreach($entity->getTestValues() as $testValue){
                $testValue->setGlucoseTest($entity);
            }
            $em->persist($entity);
            $em->flush();
            return $this->redirect($this->generateUrl('test_glucose_show', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView()
        );
    }

    /**
     * Finds and displays a BloodTest entity.
     *
     * @Route("/{id}/print", name="test_glucose_print")
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
     * @Route("/email", name="test_glucose_email")
     * @Method("POST")
     * @Template()
     */
    public function emailAction( Request $request )
    {
        $emailTestID = $this->sendTestEmail($request);
        return $this->redirect($this->generateUrl('test_glucose_show', array('id' => $emailTestID)));
    }

    /**
     * Deletes a  entity.
     *
     * @Route("/{id}/delete", name="test_glucose_delete")
     * @Method("GET")
     */
    public function deleteAction($id)
    {
        $this->deleteEntity($id);
        return $this->redirect($this->generateUrl('test_glucose'));
    }

    /**
     * Displays multiple test for printing.
     *
     * @Route("/delete/multiple", name="test_glucose_delete_multiple")
     * @Method("POST")
     * @Template()
     */
    public function deleteMultipleAction( Request $request)
    {
        $this->deleteEntries($request);
        return $this->redirect($this->generateUrl('test_glucose'));

    }

}
