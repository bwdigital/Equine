<?php

namespace Goldcrab\Delma\UserBundle\Controller;

use Doctrine\DBAL\Query\QueryBuilder;
use Goldcrab\Delma\UserBundle\Form\NewUserType;
use Goldcrab\Delma\UserBundle\Form\UserFilterType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Goldcrab\Delma\UserBundle\Entity\User;
use Goldcrab\Delma\UserBundle\Form\UserType;

/**
 * User controller.
 *
 * @Route("/user")
 */
class UserController extends Controller
{

    /**
     * Lists all User entities.
     *
     * @Route("/", name="user")
     * @Method("GET")
     * @Template()
     */
    public function indexAction(Request $request)
    {

        $em = $this->getDoctrine()->getManager();
        $repository = $em->getRepository('DelmaUserBundle:User');

        $queryBuilder = $repository->createQueryBuilder('u')
            ->select('u')
            ->andWhere(' 1=1 ');

        $filterForm = $this->createForm(new UserFilterType());
        if ($this->get('request')->query->has('submit-filter')) {
            // bind values from the request
            $filterForm->bind($this->get('request'));
            $filterData = $filterForm->getData();

            if(!is_null($filterData['q'])){
                $queryBuilder->andWhere(" u.firstname LIKE :query1 OR u.lastname LIKE :query2 OR u.username LIKE :query3 OR u.email LIKE :query4 OR u.mobile LIKE :query5 " );
                $queryBuilder->setParameter('query1', '%'.$filterData['q'].'%');
                $queryBuilder->setParameter('query2', '%'.$filterData['q'].'%');
                $queryBuilder->setParameter('query3', '%'.$filterData['q'].'%');
                $queryBuilder->setParameter('query4', '%'.$filterData['q'].'%');
                $queryBuilder->setParameter('query5', '%'.$filterData['q'].'%');
            }

            if(!is_null($filterData['loginDate'])){
                $queryBuilder->andWhere(" u.lastLogin LIKE :lastLogin ");
                $queryBuilder->setParameter('lastLogin', $filterData['loginDate']->format('Y-m-d%'));
            }

            if(!is_null($filterData['type'])){
                $queryBuilder->andWhere(" u.type = :type ");
                $queryBuilder->setParameter('type', $filterData['type']);
            }

            if(!is_null($filterData['enabled'])){
                $queryBuilder->andWhere(" u.enabled = :enabled ");
                $queryBuilder->setParameter('enabled', (int)$filterData['enabled']);
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
     * List User entities in Json.
     *
     * @Route("/list/json", name="user_list_json")
     * @Method("GET")
     * @Template()
     */
    public function jsonListAction(Request $request){

        $em = $this->getDoctrine()->getManager();
        $repository = $em->getRepository('DelmaUserBundle:User');

        /*
         * @var \Doctrine\DBAL\Query\QueryBuilder $queryBuilder
         */
        $queryBuilder = $repository->createQueryBuilder('u')
            ->select('u.id,u.firstname,u.lastname,u.email,u.mobile,u.type,u.city,u.country')
            ->add('orderBy', 'u.firstname ASC')
            ->setMaxResults(10);


        if ($request->query->has('q')) {
            $searchString = $request->query->get('q');

            $queryBuilder->andWhere(" u.firstname LIKE :query1 OR u.lastname LIKE :query2 OR u.username LIKE :query3 OR u.email LIKE :query4 OR u.mobile LIKE :query5 " );
            $queryBuilder->setParameter('query1', '%'.$searchString.'%');
            $queryBuilder->setParameter('query2', '%'.$searchString.'%');
            $queryBuilder->setParameter('query3', '%'.$searchString.'%');
            $queryBuilder->setParameter('query4', '%'.$searchString.'%');
            $queryBuilder->setParameter('query5', '%'.$searchString.'%');
        }

        $searchType = $request->query->get('type');
        if (!empty($searchType)) {
            $queryBuilder->andWhere(" u.type = :type " );
            $queryBuilder->setParameter('type', $searchType);
        }

        $result = $queryBuilder->getQuery()->getArrayResult();
        $totalCount = $queryBuilder->select('COUNT(u)')->getQuery()->getSingleScalarResult();

        $return = array(
            'count' => $totalCount,
            'users' => $result
        );

        $serializer = $this->container->get('serializer');
        $serializedReturn = $serializer->serialize($return, 'json');
        if($request->query->has('callback')){
            $callback = $request->query->get('callback');
            $serializedReturn = $callback . '(' . $serializedReturn . ')';
        }
        return new Response($serializedReturn, 200, array('Content-Type' => 'application/json'));
    }

    /**
     * Finds and displays a User entity in Json.
     *
     * @Route("/{id}/json", name="user_json")
     * @Method("GET")
     * @Template()
     */
    public function jsonDetailAction(Request $request,$id){
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('DelmaUserBundle:User')->find($id);

        if (!$entity) {
            $entity = array();
        }

        $serializer = $this->container->get('serializer');
        $serializedEntity = $serializer->serialize($entity, 'json');

        if($request->query->has('callback')){
            $callback = $request->query->get('callback');
            $serializedEntity = $callback . '(' . $serializedEntity . ')';
        }

        return new Response($serializedEntity, 200, array('Content-Type' => 'application/json'));
    }

    /**
     * Creates a new User entity.
     *
     * @Route("/", name="user_create")
     * @Method("POST")
     * @Template("DelmaUserBundle:User:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity  = new User();

        $roleHierarchy = $this->container->getParameter('security.role_hierarchy.roles');
        $roles = array_keys($roleHierarchy);

        $form = $this->createForm(new NewUserType($roles, $entity->getRoles()), $entity);
        $form->bind($request);

        if ($form->isValid()) {


            if (!$this->container->has('fos_user.util.user_manipulator')) {
                throw new \LogicException('The DoctrineBundle is not registered in your application.');
            }

            $manipulator = $this->container->get('fos_user.util.user_manipulator');
            $username = filter_var($entity->getEmail(),FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            /**
             * @var \Goldcrab\Delma\UserBundle\Entity\User $user
             */
            $user = $manipulator->create($username, $entity->getPassword(),$entity->getEmail(), true, false);
            $user->setFirstname($entity->getFirstname());
            $user->setLastname($entity->getLastname());
            $user->setMobile($entity->getMobile());
            $user->setType($entity->getType());
            $user->setRoles($entity->getRoles());

            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            return $this->redirect($this->generateUrl('user_show', array('id' => $user->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Displays a form to create a new User entity.
     *
     * @Route("/new", name="user_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {

        $roleHierarchy = $this->container->getParameter('security.role_hierarchy.roles');
        $roles = array_keys($roleHierarchy);


        $entity = new User();
        $form   = $this->createForm(new NewUserType($roles, $entity->getRoles()), $entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a User entity.
     *
     * @Route("/{id}", name="user_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('DelmaUserBundle:User')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find User entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing User entity.
     *
     * @Route("/{id}/edit", name="user_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('DelmaUserBundle:User')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find User entity.');
        }

        $editForm = $this->createForm(new UserType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing User entity.
     *
     * @Route("/{id}", name="user_update")
     * @Method("PUT")
     * @Template("DelmaUserBundle:User:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('DelmaUserBundle:User')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find User entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new UserType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();


            if(!$editForm->get('plainPassword')->isEmpty()){
                $newPassword = $editForm->get('plainPassword')->getData();
                $manipulator = $this->container->get('fos_user.util.user_manipulator');
                $manipulator->changePassword($entity->getUsername(),$newPassword);
            }

            return $this->redirect($this->generateUrl('user_edit', array('id' => $id,'_msg'=>'Updated user successfully!')));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a User entity.
     *
     * @Route("/{id}", name="user_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('DelmaUserBundle:User')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find User entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('user'));
    }

    /**
     * Creates a form to delete a User entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
