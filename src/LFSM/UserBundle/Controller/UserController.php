<?php

namespace LFSM\UserBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use LFSM\UserBundle\Form\UserType;
use Symfony\Component\DependencyInjection\ContainerInterface as Container;

/**
 * Action controller.
 *
 * @Route("/admin/utilisateurs")
 */
class UserController extends Controller {

    /**
     * Lists all Action entities.
     *
     * @Route("/", name="user_list")
     * @Template("LFSMUserBundle:User:index.html.twig")
     */
    public function indexAction()
    {        
        $em = $this->getDoctrine()->getManager();

        $query = $em->getRepository('LFSMUserBundle:User')->myFindAllQuery();

        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
                $query, $this->get('request')->query->get('page', 1)/* page number */, 10/* limit per page */
        );

        $totalPages = ceil($pagination->getTotalItemCount() / $pagination->getItemNumberPerPage());

        return array(
            'totalPages' => $totalPages,
            'pagination' => $pagination,
        );
    }
    
    /**
     * Lists all Action entities.
     *
     * @Route("/{id}/edit", name="user_edit")
     * @Template("LFSMUserBundle:User:edit.html.twig")
     */
    public function EditAction($id)
    {        
        $em = $this->getDoctrine()->getManager();

        $user = $em->getRepository('LFSMUserBundle:User')->find($id);
        
        $roles = $this->container->getParameter('security.role_hierarchy.roles');
        $currentRole = $user->getRoles();
        
        $editForm = $this->createForm(new UserType($roles, $currentRole[0]), $user);

        return array(
            'user' => $user,
            'edit_form' => $editForm->createView(),
        );
    }
    
    /**
     * Lists all Action entities.
     *
     * @Route("/{id}/update", name="user_update")
     * @Method("POST")
     * @Template("LFSMUserBundle:User:edit.html.twig")
     */
    public function UpdateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $user = $em->getRepository('LFSMUserBundle:User')->find($id);

        if (!$user) {
            throw $this->createNotFoundException('Unable to find User entity.');
        }

        $roles = $this->container->getParameter('security.role_hierarchy.roles');
        $currentRole = $user->getRoles();
        $editForm = $this->createForm(new UserType($roles, $currentRole[0]), $user);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $postDatas = current($request->request->all());
            $user->setRoles(array($postDatas['roles']));
            $em->flush();

            return $this->redirect($this->generateUrl('user_list'));
        }

        return array(
            'user'      => $user,
            'edit_form'   => $editForm->createView(),
        );
    }
}
