<?php

namespace LFSM\AdminBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use LFSM\AdminBundle\Entity\Statut;
use LFSM\AdminBundle\Form\StatutType;

/**
 * Statut controller.
 *
 * @Route("statut")
 */
class StatutController extends Controller {

    /**
     * Lists all Statut entities.
     *
     * @Route("/", name="statut")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $query = $em->getRepository('LFSMAdminBundle:Statut')->myFindAllQuery();

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
     * Displays a form to create a new Statut entity.
     *
     * @Route("/new", name="statut_new")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Statut();
        $form = $this->createForm(new StatutType(), $entity);

        return array(
            'entity' => $entity,
            'form' => $form->createView(),
        );
    }

    /**
     * Creates a new Statut entity.
     *
     * @Route("/create", name="statut_create")
     * @Method("POST")
     * @Template("LFSMAdminBundle:Statut:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Statut();
        $form = $this->createForm(new StatutType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('statut'));
        }

        return array(
            'entity' => $entity,
            'form' => $form->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Statut entity.
     *
     * @Route("/{id}/edit", name="statut_edit")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('LFSMAdminBundle:Statut')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Statut entity.');
        }

        $editForm = $this->createForm(new StatutType(), $entity);

        return array(
            'entity' => $entity,
            'edit_form' => $editForm->createView()
        );
    }

    /**
     * Edits an existing Statut entity.
     *
     * @Route("/{id}/update", name="statut_update")
     * @Method("POST")
     * @Template("LFSMAdminBundle:Statut:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('LFSMAdminBundle:Statut')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Statut entity.');
        }

        $editForm = $this->createForm(new StatutType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('statut'));
        }

        return array(
            'entity' => $entity,
            'edit_form' => $editForm->createView()
        );
    }

    /**
     * Deletes a Statut entity.
     *
     * @Route("/{id}/delete", name="statut_delete")
     */
    public function deleteAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('LFSMAdminBundle:Statut')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Statut entity.');
        }

        $em->remove($entity);
        $em->flush();

        return $this->redirect($this->generateUrl('statut'));
    }

}
