<?php

namespace LFSM\AdminBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use LFSM\AdminBundle\Entity\Etat;
use LFSM\AdminBundle\Form\EtatType;

/**
 * Etat controller.
 *
 * @Route("/etat")
 */
class EtatController extends Controller {

    /**
     * Lists all Etat entities.
     *
     * @Route("/", name="etat")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $query = $em->getRepository('LFSMAdminBundle:Etat')->myFindAllQuery();

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
     * Displays a form to create a new Etat entity.
     *
     * @Route("/new", name="etat_new")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Etat();
        $form = $this->createForm(new EtatType(), $entity);

        return array(
            'entity' => $entity,
            'form' => $form->createView(),
        );
    }

    /**
     * Creates a new Etat entity.
     *
     * @Route("/create", name="etat_create")
     * @Method("POST")
     * @Template("LFSMAdminBundle:Etat:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Etat();
        $form = $this->createForm(new EtatType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('etat', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form' => $form->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Etat entity.
     *
     * @Route("/{id}/edit", name="etat_edit")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('LFSMAdminBundle:Etat')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Etat entity.');
        }

        $editForm = $this->createForm(new EtatType(), $entity);

        return array(
            'entity' => $entity,
            'edit_form' => $editForm->createView()
        );
    }

    /**
     * Edits an existing Etat entity.
     *
     * @Route("/{id}/update", name="etat_update")
     * @Method("POST")
     * @Template("LFSMAdminBundle:Etat:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('LFSMAdminBundle:Etat')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Etat entity.');
        }

        $editForm = $this->createForm(new EtatType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('etat', array('id' => $id)));
        }

        return array(
            'entity' => $entity,
            'edit_form' => $editForm->createView()
        );
    }

    /**
     * Deletes a Etat entity.
     *
     * @Route("/{id}/delete", name="etat_delete")
     */
    public function deleteAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('LFSMAdminBundle:Etat')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Etat entity.');
        }

        $em->remove($entity);
        $em->flush();


        return $this->redirect($this->generateUrl('etat'));
    }

}
