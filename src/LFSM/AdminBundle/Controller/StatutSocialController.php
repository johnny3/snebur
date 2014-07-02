<?php

namespace LFSM\AdminBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use LFSM\AdminBundle\Entity\StatutSocial;
use LFSM\AdminBundle\Form\StatutSocialType;

/**
 * StatutSocial controller.
 *
 * @Route("/statutsocial")
 */
class StatutSocialController extends Controller
{
    /**
     * Lists all StatutSocial entities.
     *
     * @Route("/", name="statutsocial")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $query = $em->getRepository('LFSMAdminBundle:StatutSocial')->myFindAllQuery();

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
     * Displays a form to create a new StatutSocial entity.
     *
     * @Route("/new", name="statutsocial_new")
     * @Template()
     */
    public function newAction()
    {
        $entity = new StatutSocial();
        $form   = $this->createForm(new StatutSocialType(), $entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a new StatutSocial entity.
     *
     * @Route("/create", name="statutsocial_create")
     * @Method("POST")
     * @Template("LFSMAdminBundle:StatutSocial:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity  = new StatutSocial();
        $form = $this->createForm(new StatutSocialType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('statutsocial'));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Displays a form to edit an existing StatutSocial entity.
     *
     * @Route("/{id}/edit", name="statutsocial_edit")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('LFSMAdminBundle:StatutSocial')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find StatutSocial entity.');
        }

        $editForm = $this->createForm(new StatutSocialType(), $entity);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
        );
    }

    /**
     * Edits an existing StatutSocial entity.
     *
     * @Route("/{id}/update", name="statutsocial_update")
     * @Method("POST")
     * @Template("LFSMAdminBundle:StatutSocial:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('LFSMAdminBundle:StatutSocial')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find StatutSocial entity.');
        }

        $editForm = $this->createForm(new StatutSocialType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('statutsocial'));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
        );
    }

    /**
     * Deletes a StatutSocial entity.
     *
     * @Route("/{id}/delete", name="statutsocial_delete")
     */
    public function deleteAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('LFSMAdminBundle:StatutSocial')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find StatutSocial entity.');
        }

        $em->remove($entity);
        $em->flush();

        return $this->redirect($this->generateUrl('statutsocial'));
    }
}
