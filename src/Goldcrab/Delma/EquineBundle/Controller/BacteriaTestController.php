<?php

namespace Goldcrab\Delma\EquineBundle\Controller;

use Doctrine\Common\Collections\ArrayCollection;
use Goldcrab\Delma\EquineBundle\Entity\BacteriaEntry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Goldcrab\Delma\EquineBundle\Entity\BacteriaTest;
use Goldcrab\Delma\EquineBundle\Form\BacteriaTestType;

/**
 * BacteriaTest controller.
 *
 * @Route("/test/bacteria")
 */
class BacteriaTestController extends TestController
{

    function __construct()
    {
        $this->repositoryName = 'DelmaEquineBundle:BacteriaTest';
        $this->pdfOrientation = 'P';
    }


    /**
     * Lists all BacteriaTest entities.
     *
     * @Route("/", name="test_bacteria")
     * @Method("GET")
     * @Template()
     */
    public function indexAction( Request $request)
    {
        return parent::indexAction($request);
    }

    /**
     * Creates a new BacteriaTest entity.
     *
     * @Route("/", name="test_bacteria_create")
     * @Method("POST")
     * @Template("DelmaEquineBundle:BacteriaTest:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new BacteriaTest();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            foreach($entity->getTestValues() as $testValue){
                $testValue->setBacteriaTest($entity);
            }
            $em->persist($entity);
            $em->flush();
            return $this->redirect($this->generateUrl('test_bacteria_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
    * Creates a form to create a BacteriaTest entity.
    *
    * @param BacteriaTest $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(BacteriaTest $entity)
    {
        $form = $this->createForm(new BacteriaTestType($this->getDoctrine()->getManager()), $entity, array(
            'action' => $this->generateUrl('test_bacteria_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new BacteriaTest entity.
     *
     * @Route("/new", name="test_bacteria_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new BacteriaTest();

        //Populate Form Default values
        $entity->setTestedDate(new \DateTime());
        $entity->setSampleDate(new \DateTime());
        $user = $this->get('security.context')->getToken()->getUser();
        if($user->getType()=='Lab'){
            $entity->setTestedBy($user);
        }


        $em = $this->getDoctrine()->getManager();
        $repository = $em->getRepository('DelmaEquineBundle:Antibiotic');
        $queryBuilder = $repository->createQueryBuilder('A')
            ->select(array('A'))
            ->andWhere(' 1=1 ');
        $queryBuilder->addOrderBy('A.order','ASC');
        $query = $queryBuilder->getQuery();
        $antibiotics = $query->getResult();


        $testValues = new ArrayCollection();
        foreach($antibiotics as $antibiotic){
            $testValue = new BacteriaEntry();
            $testValue->setAntibiotics($antibiotic->getName());
            $testValue->setCode($antibiotic->getCode());
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
     * Finds and displays a BacteriaTest entity.
     *
     * @Route("/{id}", name="test_bacteria_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('DelmaEquineBundle:BacteriaTest')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find BacteriaTest entity.');
        }

        return array(
            'entity' => $entity
        );
    }

    /**
     * Displays a form to edit an existing BacteriaTest entity.
     *
     * @Route("/{id}/edit", name="test_bacteria_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('DelmaEquineBundle:BacteriaTest')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find BacteriaTest entity.');
        }

        $editForm = $this->createEditForm($entity);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView()
        );
    }

    /**
    * Creates a form to edit a BacteriaTest entity.
    *
    * @param BacteriaTest $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(BacteriaTest $entity)
    {
        $form = $this->createForm(new BacteriaTestType($this->getDoctrine()->getManager()), $entity, array(
            'action' => $this->generateUrl('test_bacteria_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing BacteriaTest entity.
     *
     * @Route("/{id}", name="test_bacteria_update")
     * @Method("PUT")
     * @Template("DelmaEquineBundle:BacteriaTest:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        /**
         * @var BacteriaTest $entity
         * @var BacteriaEntry $testValue
         */
        $entity = $em->getRepository('DelmaEquineBundle:BacteriaTest')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find BacteriaTest entity.');
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
                $testValue->setBacteriaTest(null);
                $entity->removeTestValue($testValue);
                $em->remove($testValue);
            }

            foreach($entity->getTestValues() as $testValue){
                $testValue->setBacteriaTest($entity);
            }
            $em->persist($entity);
            $em->flush();
            return $this->redirect($this->generateUrl('test_bacteria_show', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView()
        );
    }

    function getAntibioticsList(){
        return array(
            'CDE001' => "AMIKACIN",
            'CDE002' => "AMPICILLIN",
            'CDE003' => "AZITHROMYCIN",
            'CDE004' => "CEFOTAXIME",
            'CDE005' => "CEFTAZIDIME",
            'CDE006' => "CEFTIOFUR",
            'CDE007' => "CHLORAMPHENICOL",
            'CDE008' => "CIPROFIOXACIN",
            'CDE009' => "DOXYCYCLINE",
            'CDE010' => "ENROFLOXACIN",
            'CDE011' => "ERYTHROMYCIN",
            'CDE012' => "GENTAMYCIN",
            'CDE013' => "IMIPENEM",
            'CDE014' => "NEOMYCIN",
            'CDE015' => "OXACILLIN",
            'CDE016' => "OXYTETRACYCLIN/TETRACYCLINE",
            'CDE017' => "PENICILLIN G.",
            'CDE018' => "POLYMYXIN B",
            'CDE019' => "RIFAMPICIN",
            'CDE020' => "STREPTOMYCIN",
            'CDE021' => "TICARCILLIN",
            'CDE022' => "TICARCILLIN CLAVULANIC ACID",
            'CDE023' => "TRIMETHOPRIM/SULFAMETHOXAZOLE"
        );
    }

    /**
     * Finds and displays a BloodTest entity.
     *
     * @Route("/{id}/print", name="test_bacteria_print")
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
     * @Route("/email", name="test_bacteria_email")
     * @Method("POST")
     * @Template()
     */
    public function emailAction( Request $request )
    {
        $emailTestID = $this->sendTestEmail($request);
        return $this->redirect($this->generateUrl('test_bacteria_show', array('id' => $emailTestID)));
    }

    /**
     * Deletes a  entity.
     *
     * @Route("/{id}/delete", name="test_bacteria_delete")
     * @Method("GET")
     */
    public function deleteAction($id)
    {
        $this->deleteEntity($id);
        return $this->redirect($this->generateUrl('test_bacteria'));
    }

    /**
     * Displays multiple test for printing.
     *
     * @Route("/delete/multiple", name="test_bacteria_delete_multiple")
     * @Method("POST")
     * @Template()
     */
    public function deleteMultipleAction( Request $request)
    {
        $this->deleteEntries($request);
        return $this->redirect($this->generateUrl('test_bacteria'));

    }

}
