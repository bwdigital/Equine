<?php

namespace Goldcrab\Delma\EquineBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Goldcrab\Delma\EquineBundle\Entity\BloodTest;
use Goldcrab\Delma\EquineBundle\Form\BloodTestType;
use Goldcrab\Delma\EquineBundle\Form\EmailType;

/**
 * BloodTest controller.
 *
 * @Route("/test/blood")
 */
class BloodTestController extends TestController
{


    function __construct()
    {
        $this->repositoryName = 'DelmaEquineBundle:BloodTest';
        $this->pdfOrientation = 'L';

    }

    /**
     * Lists all BloodTest entities.
     *
     * @Route("/", name="test_blood")
     * @Method("GET")
     * @Template()
     */
    public function indexAction( Request $request)
    {
        return parent::indexAction($request);
    }

    /**
     * Creates a new BloodTest entity.
     *
     * @Route("/", name="test_blood_create")
     * @Method("POST")
     * @Template("DelmaEquineBundle:BloodTest:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $entity  = new BloodTest();
        $form = $this->createForm(new BloodTestType($em), $entity);
        $form->submit($request);

        if ($form->isValid()) {

            $em->persist($entity);
            $em->flush();
            if($request->get('submitButton')=='Save & New'){
                return $this->redirect($this->generateUrl('test_blood_new',array('_msg'=>'Blood test created successfully!')));
                exit();
            }
            if($request->get('submitButton')=='Save & List'){
                return $this->redirect($this->generateUrl('test_blood',array('_msg'=>'Blood test created successfully!')));
                exit();
            }
            return $this->redirect($this->generateUrl('test_blood_show', array('id' => $entity->getId(), '_msg'=>'Blood test created successfully!' )));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Displays a form to create a new BloodTest entity.
     *
     * @Route("/new", name="test_blood_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new BloodTest();

        $em = $this->getDoctrine()->getManager();
        $repository = $em->getRepository($this->repositoryName);

        $queryBuilder = $repository->createQueryBuilder('t')
            ->select(array('t','h','s','d','b'))
            ->leftJoin('t.horse', 'h')
            ->leftJoin('h.stable', 's')
            ->leftJoin('t.doctor', 'd')
            ->leftJoin('t.testedBy', 'b')
            //->andWhere(" t.id IN(2223) ")
            ->addOrderBy('t.testedDate','DESC')
            ->setMaxResults(1);
        $lastTestEntry = $queryBuilder->getQuery()->getArrayResult();

        if(!empty($lastTestEntry[0])){
            $lastEntryDoctor = $em->getRepository('DelmaUserBundle:User')->find($lastTestEntry[0]['doctor']['id']);
            $entity->setDoctor($lastEntryDoctor);
        }

        //Populate Form Default values
        $entity->setTestedDate(new \DateTime());
        $user = $this->get('security.context')->getToken()->getUser();
        if($user->getType()=='Lab'){
            $entity->setTestedBy($user);
        }

        $form   = $this->createForm(new BloodTestType(  $this->getDoctrine()->getManager() ), $entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Displays a form to create a new BloodTest entity.
     *
     * @Route("/test", name="test_blood_test")
     * @Method("GET")
     * @Template()
     */
    public function testAction(Request $request){

        $data = array( 'emails' => array('hmimthiaz@imthi.com','imthi@flip.me'));

        $builder = $this->createFormBuilder($data);

        $builder->add('testedFromDate','date',
            array(
                'widget' => 'single_text',
                'required' => false,
                'format' => 'dd-MM-yyyy',
                'label' => 'Tested Date',
                'attr' => array('class' => 'date')
            )
        );

        $builder->add('emails', 'collection', array(
            // each item in the array will be an "email" field
            'type'   => 'email',
            'prototype'  => true,
            'allow_add' => true,
            'allow_delete' => true,
            // these options are passed to each "email" type
            'options'  => array(
                'required'  => false,
                'attr'      => array('class' => 'email-box')
            ),
        ));

        return array(
            'form' =>  $builder->getForm()->createView()
        );
    }

    /**
     * Finds and displays a BloodTest entity.
     *
     * @Route("/{id}", name="test_blood_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('DelmaEquineBundle:BloodTest')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find BloodTest entity.');
        }

        return array(
            'entity'      => $entity
        );
    }


    /**
     * Finds and displays a BloodTest entity.
     *
     * @Route("/{id}/print", name="test_blood_print")
     * @Method("GET")
     * @Template()
     */
    public function printAction($id)
    {
        return parent::printAction($id);
    }

    /**
     * Displays multiple test for printing.
     *
     * @Route("/print/multiple", name="test_blood_print_multiple")
     * @Method("POST")
     * @Template()
     */
    public function printMultipleAction( Request $request)
    {

        $em = $this->getDoctrine()->getManager();
        $repository = $em->getRepository($this->repositoryName);

        $queryBuilder = $repository->createQueryBuilder('t')
            ->select(array('t','h','s','d','b'))
            ->leftJoin('t.horse', 'h')
            ->leftJoin('h.stable', 's')
            ->leftJoin('t.doctor', 'd')
            ->leftJoin('t.testedBy', 'b')
            ->andWhere(' 1=1 ')
            ->addOrderBy('t.testedDate','DESC');


        $printTestIds = $request->request->get('test');
        if(!empty($printTestIds)){
            $queryBuilder->andWhere(" t.id IN(:printIds) ");
            $queryBuilder->setParameter('printIds', array_values($printTestIds));
        }

        $printShowTabs = strtolower( $request->request->get('show') );
        $showHema = true;
        $showChem = true;
        $showElec = true;
        if($printShowTabs=='hema'){
            $showChem = false;
            $showElec = false;
        }else if($printShowTabs=='chem'){
            $showHema = false;
            $showElec = false;
        }else if($printShowTabs=='elec'){
            $showHema = false;
            $showChem = false;
        }

        $query = $queryBuilder->getQuery();
        $entities = $query->getResult();

        $firstTestDate = $entities[0]->getTestedDate();
        $lastTestDate = $entities[count($entities)-1]->getTestedDate();


        $singleHorse = true;
        $singleHorseId = false;

        $singleStable = true;
        $singleStableId = false;
        foreach($entities as $entity){
            if($singleHorseId===false){
                $singleHorseId = $entity->getHorse()->getId();
            }else{
                if($singleHorseId!=$entity->getHorse()->getId()){
                    $singleHorse = false;
                }
            }
            if($singleStableId===false){
                $singleStableId = $entity->getHorse()->getStable()->getId();
            }else{
                if($singleStableId!=$entity->getHorse()->getStable()->getId()){
                    $singleStable = false;
                }
            }
        }

        $horseInfo = false;
        if($singleHorse){
            $horseInfo = $em->getRepository('DelmaEquineBundle:Horse')->find($singleHorseId);
        }

        $stableInfo = false;
        if($singleStable){
            $stableInfo = $em->getRepository('DelmaEquineBundle:Stable')->find($singleStableId);
        }

        return array(
            'firstTestDate' => $firstTestDate,
            'lastTestDate' => $lastTestDate,
            'entities' => $entities,
            'singleHorse' => $singleHorse,
            'horseInfo' => $horseInfo,
            'singleStable' => $singleStable,
            'stableInfo' => $stableInfo,
            'showHema' => $showHema,
            'showChem' => $showChem,
            'showElec' => $showElec
        );
    }

    /**
     * Finds and displays a Horse entity in Json.
     *
     * @Route("/horse/{id}/latest/json", name="blood_horse_latest_json")
     * @Method("GET")
     * @Template()
     */
    public function jsonDetailAction(Request $request,$id){
        $em = $this->getDoctrine()->getManager();
        $repository = $em->getRepository($this->repositoryName);

        $queryBuilder = $repository->createQueryBuilder('t')
            ->select(array('t'))
            ->leftJoin('t.horse', 'h')
            ->leftJoin('h.stable', 's')
            ->leftJoin('t.doctor', 'd')
            ->leftJoin('t.testedBy', 'b')
            ->setMaxResults(1)
            ->addOrderBy('t.id','DESC')
            ->andWhere(' 1=1 ');
        $queryBuilder->andWhere(" h.id = :horseId ");
        $queryBuilder->setParameter('horseId', $id);

        $query = $queryBuilder->getQuery();
        $entities = $query->getOneOrNullResult();

        if(is_null($entities)){
            $entities = array();
        }

        $serializer = $this->container->get('serializer');
        $serializedEntity = $serializer->serialize($entities, 'json');

        if($request->query->has('callback')){
            $callback = $request->query->get('callback');
            $serializedEntity = $callback . '(' . $serializedEntity . ')';
        }

        return new Response($serializedEntity, 200, array('Content-Type' => 'application/json'));
    }

    /**
     * Finds and displays a BloodTest entity.
     *
     * @Route("/email", name="test_blood_email")
     * @Method("POST")
     * @Template()
     */
    public function emailAction( Request $request )
    {
        $emailTestID = $this->sendTestEmail($request);
        return $this->redirect($this->generateUrl('test_blood_show', array('id' => $emailTestID)));
    }

    /**
     * Displays multiple test for printing.
     *
     * @Route("/email/multiple", name="test_blood_email_multiple")
     * @Method("POST")
     * @Template()
     */
    public function emailMultipleAction( Request $request)
    {

        $em = $this->getDoctrine()->getManager();
        $repository = $em->getRepository($this->repositoryName);

        $queryBuilder = $repository->createQueryBuilder('t')
            ->select(array('t','h','s','d','b'))
            ->leftJoin('t.horse', 'h')
            ->leftJoin('h.stable', 's')
            ->leftJoin('t.doctor', 'd')
            ->leftJoin('t.testedBy', 'b')
            ->andWhere(' 1=1 ');

        $printTestIds = $request->request->get('test');
        if(!empty($printTestIds)){
            $queryBuilder->andWhere(" t.id IN(:printIds) ");
            $queryBuilder->setParameter('printIds', array_values($printTestIds));
        }


        $printShowTabs = strtolower( $request->request->get('show') );
        $showHema = true;
        $showChem = true;
        $showElec = true;
        if($printShowTabs=='hema'){
            $showChem = false;
            $showElec = false;
        }else if($printShowTabs=='chem'){
            $showHema = false;
            $showElec = false;
        }else if($printShowTabs=='elec'){
            $showHema = false;
            $showChem = false;
        }

        $query = $queryBuilder->getQuery();
        $entities = $query->getResult();

        $logger = new \Swift_Plugins_Loggers_EchoLogger();
        $this->get('mailer')->registerPlugin(new \Swift_Plugins_LoggerPlugin($logger));

        $content = $this->renderView('DelmaEquineBundle:BloodTest:emailMultiple.html.twig',array(
            'entities' => $entities,
            'showHema' => $showHema,
            'showChem' => $showChem,
            'showElec' => $showElec
        ));

        $toUser = $request->request->get('toUser');
        $toUserEntity = $em->getRepository('DelmaUserBundle:User')->find($toUser);
        $toSubject = $request->request->get('toSubject');
        $toBody = $request->request->get('toBody');

        $html2pdf = $this->get('html2pdf')->get();
        $html2pdf->WriteHTML($content);
        $html2pdf->Output('/tmp/report.pdf','F');

        $currentUser = $this->get('security.context')->getToken()->getUser();
        $message = \Swift_Message::newInstance()
            ->setSubject($toSubject)
            ->setFrom($currentUser->getEmail(),$currentUser->getFirstname())
            ->setTo($toUserEntity->getEmail(),$toUserEntity->getFirstname())
            ->attach( \Swift_Attachment::fromPath('/tmp/report.pdf')->setFilename('Report.pdf') )
            ->setBody( nl2br( $toBody ) ,'text/html');
        $this->get('mailer')->send($message);

        return $this->redirect($this->generateUrl('test_blood'));

    }


    /**
     * Displays a form to edit an existing BloodTest entity.
     *
     * @Route("/{id}/edit", name="test_blood_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('DelmaEquineBundle:BloodTest')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find BloodTest entity.');
        }

        $editForm = $this->createForm(new BloodTestType( $em ), $entity);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView()
        );
    }

    /**
     * Edits an existing BloodTest entity.
     *
     * @Route("/{id}", name="test_blood_update")
     * @Method("PUT")
     * @Template("DelmaEquineBundle:BloodTest:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('DelmaEquineBundle:BloodTest')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find BloodTest entity.');
        }

        $editForm = $this->createForm(new BloodTestType( $em ), $entity);
        $editForm->submit($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            if($request->get('submitButton')=='Save & New'){
                return $this->redirect($this->generateUrl('test_blood_new',array('_msg'=>'Blood test created successfully!')));
                exit();
            }
            if($request->get('submitButton')=='Save & List'){
                return $this->redirect($this->generateUrl('test_blood',array('_msg'=>'Blood test created successfully!')));
                exit();
            }
            return $this->redirect($this->generateUrl('test_blood_show', array('id' => $entity->getId())));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView()
        );
    }



    /**
     * Deletes a  entity.
     *
     * @Route("/{id}/delete", name="test_blood_delete")
     * @Method("GET")
     */
    public function deleteAction($id)
    {
        $this->deleteEntity($id);
        return $this->redirect($this->generateUrl('test_blood'));
    }


    /**
     * Displays multiple test for printing.
     *
     * @Route("/delete/multiple", name="test_blood_delete_multiple")
     * @Method("POST")
     * @Template()
     */
    public function deleteMultipleAction( Request $request)
    {
        $this->deleteEntries($request);
        return $this->redirect($this->generateUrl('test_blood'));

    }
}
