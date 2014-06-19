<?php

namespace Goldcrab\Delma\EquineBundle\Controller;

use Goldcrab\Delma\EquineBundle\Form\DataTransformer\HorseToNumberTransformer;
use Goldcrab\Delma\EquineBundle\Form\DataTransformer\UserToNumberTransformer;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form;
use Doctrine\ORM\QueryBuilder;


class TestController extends Controller
{

    protected $repositoryName;
    protected $pdfOrientation;

    public function indexAction( Request $request)
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

        $filterForm = $this->getFilterForm();

        $isFilterApplied = $this->applyFilter($filterForm,$request,$queryBuilder);

        $currentUser = $this->get('security.context')->getToken()->getUser();
        if($currentUser->getType()=='Doctor'){
            $queryBuilder->andWhere(" d.id = :doctorId ");
            $queryBuilder->setParameter('doctorId', $currentUser->getId());
        }

        $query = $queryBuilder->getQuery();
        $paginator  = $this->get('knp_paginator');
        if($isFilterApplied){
            $pagination = $paginator->paginate( $query ,$this->get('request')->query->get('page', 1),100);
        }else{
            $pagination = $paginator->paginate( $query ,$this->get('request')->query->get('page', 1),30);
        }
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

        $em = $this->getDoctrine()->getManager();
        $horseTransformer = new HorseToNumberTransformer($em);

        $builder->add(
            $builder->create('horse', 'text',array(
                'attr' => array(
                    'style' => "width:80%",
                    'class' => 'horseAutoCompleteSelector'
                ),
                'required' => false,
                'label' => 'Name'
            ))->addModelTransformer($horseTransformer)
        );

        $builder->add('stable', 'genemu_jqueryselect2_entity', array(
            'attr' => array(
                'style' => "width:80%",
            ),
            'class' => 'DelmaEquineBundle:Stable',
            'property' => 'name',
            'required' => false,
            'empty_value' => '',
            'label' => 'Stable'
        ));

        $userTransformer = new UserToNumberTransformer($em);
        $currentUser = $this->get('security.context')->getToken()->getUser();
        if($currentUser->getType()!='Doctor'){
            $builder->add(
                $builder->create('doctor', 'text',array(
                    'attr' => array(
                        'style' => "width:80%",
                        'class' => 'userAutoCompleteSelector',
                        'data-userType' => 'Doctor'
                    ),
                    'required' => false,
                    'label' => 'Doctor'
                ))->addModelTransformer($userTransformer)
            );
        }

        $builder->add(
            $builder->create('testedBy', 'text',array(
                'attr' => array(
                    'style' => "width:80%",
                    'class' => 'userAutoCompleteSelector',
                    'data-userType' => 'Lab'
                ),
                'required' => false,
                'label' => 'Tested By'
            ))->addModelTransformer($userTransformer)
        );

        $builder->add('testedFromDate','text',
            array(
                'required' => false,
                'label' => 'Tested Date',
                'attr' => array('class' => 'date')
            )
        );

        $builder->add('testedToDate','text',
            array(
                'required' => false,
                'label' => 'Tested Date',
                'attr' => array('class' => 'date')
            )
        );

        $builder->add('filter', 'submit', array(
            'attr' => array('class' => 'filter'),
        ));

        $builder->setMethod('GET');

        return $builder->getForm();
    }

    function applyFilter(Form\Form $filterForm, Request $request, QueryBuilder $queryBuilder){
        $isFilterApplied = false;

        $filterForm->handleRequest($request);
        if ($filterForm->get('filter')->isClicked()) {

            if(!$filterForm->get('horse')->isEmpty()){
                $horse = $filterForm->get('horse')->getData();
                $queryBuilder->andWhere(" h.id = :horseId ");
                $queryBuilder->setParameter('horseId', $horse->getId());
                $isFilterApplied = true;
            }

            if(!$filterForm->get('stable')->isEmpty()){
                $stable = $filterForm->get('stable')->getData();
                $queryBuilder->andWhere(" s.id = :stableId ");
                $queryBuilder->setParameter('stableId', $stable->getId());
                $isFilterApplied = true;
            }

            $currentUser = $this->get('security.context')->getToken()->getUser();
            if($currentUser->getType()!='Doctor'){
                if(!$filterForm->get('doctor')->isEmpty()){
                    $doctor = $filterForm->get('doctor')->getData();
                    $queryBuilder->andWhere(" d.id = :doctorId ");
                    $queryBuilder->setParameter('doctorId', $doctor->getId());
                    $isFilterApplied = true;
                }
            }


            if(!$filterForm->get('testedBy')->isEmpty()){
                $testedBy = $filterForm->get('testedBy')->getData();
                $queryBuilder->andWhere(" b.id = :testedBy ");
                $queryBuilder->setParameter('testedBy', $testedBy->getId());
                $isFilterApplied = true;
            }

            if(!$filterForm->get('testedFromDate')->isEmpty()){
                $testedFromDate = $filterForm->get('testedFromDate')->getData();
                $queryBuilder->andWhere(" t.testedDate >= :testedFromDate ");
                $queryBuilder->setParameter('testedFromDate', $testedFromDate);
                $isFilterApplied = true;
            }

            if(!$filterForm->get('testedToDate')->isEmpty()){
                $testedToDate = $filterForm->get('testedToDate')->getData();
                $queryBuilder->andWhere(" t.testedDate <= :testedToDate ");
                $queryBuilder->setParameter('testedToDate', $testedToDate);
                $isFilterApplied = true;
            }
        }
        return $isFilterApplied;
    }


    public function printAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository($this->repositoryName)->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Test entity.');
        }

        return array(
            'entity' => $entity
        );
    }

    public function sendTestEmail(Request $request){
        $emailTestID = $request->request->get('emailTestID');
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository($this->repositoryName)->find($emailTestID);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find BloodTest entity.');
        }

        $content = $this->renderView($this->repositoryName .':email.html.twig',array('entity' => $entity));

        $html2pdf = $this->get('html2pdf');
        $html2pdf->mode = $this->pdfOrientation;
        $html2pdf = $html2pdf->get();
        $html2pdf->WriteHTML($content);

        if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
            $path = "c:\\windows\\temp";
        }else{
            $path = "/tmp";
        }
        $html2pdf->Output( $path . DIRECTORY_SEPARATOR . 'report.pdf','F');

        $toUser = $request->request->get('toUser');
        $toUserEntity = $em->getRepository('DelmaUserBundle:User')->find($toUser);
        $toSubject = $request->request->get('toSubject');
        $toBody = $request->request->get('toBody');

        $currentUser = $this->get('security.context')->getToken()->getUser();
        $message = \Swift_Message::newInstance()
            ->setSubject($toSubject)
//            ->setFrom('hmimthiaz@imthi.com','Lab Reports')
            ->setFrom('DEH.Labreport@dubaiequine.ae','Lab Reports')
            ->setTo($toUserEntity->getEmail(),$toUserEntity->getFirstname())
            ->attach( \Swift_Attachment::fromPath($path . DIRECTORY_SEPARATOR . 'report.pdf')->setFilename('Report.pdf') )
            ->setBody( nl2br( $toBody ) ,'text/html');
        // $this->get('mailer')->send($message);


        $transport = \Swift_SmtpTransport::newInstance('smtp.dubaiequine.ae', 25)
        ->setUsername('DEH.Labreport@dubaiequine.ae')
        ->setPassword('DLR@1234');

        $transport = \Swift_SmtpTransport::newInstance('smtp.gmail.com', 465, 'ssl')
            ->setUsername('hmimthiaz@imthi.com')
            ->setPassword(base64_decode('aVIyNSFiODE='));

        $mailer = \Swift_Mailer::newInstance($transport);
        $result = $mailer->send($message);

        return $emailTestID;
    }


    public function deleteEntity($id){
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository($this->repositoryName)->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Test entity.');
        }
        $em->remove($entity);
        $em->flush();
        return true;
    }

    public function deleteEntries( Request $request)
    {

        $em = $this->getDoctrine()->getManager();
        $repository = $em->getRepository($this->repositoryName);

        $queryBuilder = $repository->createQueryBuilder('t')
            ->select(array('t'))
            ->andWhere(' 1=1 ');

        $printTestIds = $request->request->get('test');
        if(!empty($printTestIds)){
            $queryBuilder->andWhere(" t.id IN(:printIds) ");
            $queryBuilder->setParameter('printIds', array_values($printTestIds));

            $query = $queryBuilder->getQuery();
            $entities = $query->getResult();

            foreach($entities as $entity){
                $em->remove($entity);
            }
            $em->flush();
        }
        return true;
    }



}
