<?php

namespace LFSM\AdminBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use LFSM\AdminBundle\Entity\Liste;
use LFSM\AdminBundle\Form\ListeType;

/**
 * Liste controller.
 *
 * @Route("/liste")
 */
class ListeController extends Controller
{
    /**
     * Lists all Liste entities.
     *
     * @Route("/", name="liste")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $query = $em->getRepository('LFSMAdminBundle:Liste')->myFindAllQuery();

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
     * Displays a form to create a new Liste entity.
     *
     * @Route("/new", name="liste_new")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Liste();
        $form   = $this->createForm(new ListeType(), $entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a new Liste entity.
     *
     * @Route("/create", name="liste_create")
     * @Method("POST")
     * @Template("LFSMAdminBundle:Liste:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity  = new Liste();
        $form = $this->createForm(new ListeType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('liste', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Liste entity.
     *
     * @Route("/{id}/edit", name="liste_edit")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('LFSMAdminBundle:Liste')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Liste entity.');
        }

        $editForm = $this->createForm(new ListeType(), $entity);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
        );
    }

    /**
     * Edits an existing Liste entity.
     *
     * @Route("/{id}/update", name="liste_update")
     * @Method("POST")
     * @Template("LFSMAdminBundle:Liste:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('LFSMAdminBundle:Liste')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Liste entity.');
        }

        $editForm = $this->createForm(new ListeType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('liste', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
        );
    }

    /**
     * Deletes a Liste entity.
     *
     * @Route("/{id}/delete", name="liste_delete")
     */
    public function deleteAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('LFSMAdminBundle:Liste')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Liste entity.');
        }

        $em->remove($entity);
        $em->flush();

        return $this->redirect($this->generateUrl('liste'));
    }
}
