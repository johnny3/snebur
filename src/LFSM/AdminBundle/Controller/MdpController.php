<?php

namespace LFSM\AdminBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use LFSM\AdminBundle\Entity\Mdp;
use LFSM\AdminBundle\Form\MdpType;

/**
 * Mdp controller.
 *
 * @Route("/mode-de-paiement")
 */
class MdpController extends Controller {

    /**
     * Lists all Mdp entities.
     *
     * @Route("/", name="mode_de_paiement")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $query = $em->getRepository('LFSMAdminBundle:Mdp')->myFindAllQuery();

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
     * Displays a form to create a new Mdp entity.
     *
     * @Route("/new", name="mdp_new")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Mdp();
        $form = $this->createForm(new MdpType(), $entity);

        return array(
            'entity' => $entity,
            'form' => $form->createView(),
        );
    }

    /**
     * Creates a new Mdp entity.
     *
     * @Route("/create", name="mdp_create")
     * @Method("POST")
     * @Template("LFSMAdminBundle:Mdp:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Mdp();
        $form = $this->createForm(new MdpType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('mdp', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form' => $form->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Mdp entity.
     *
     * @Route("/{id}/edit", name="mdp_edit")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('LFSMAdminBundle:Mdp')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Mdp entity.');
        }

        $editForm = $this->createForm(new MdpType(), $entity);

        return array(
            'entity' => $entity,
            'edit_form' => $editForm->createView()
        );
    }

    /**
     * Edits an existing Mdp entity.
     *
     * @Route("/{id}/update", name="mdp_update")
     * @Method("POST")
     * @Template("LFSMAdminBundle:Mdp:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('LFSMAdminBundle:Mdp')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Mdp entity.');
        }

        $editForm = $this->createForm(new MdpType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('mdp', array('id' => $id)));
        }

        return array(
            'entity' => $entity,
            'edit_form' => $editForm->createView()
        );
    }

    /**
     * Deletes a Mdp entity.
     *
     * @Route("/{id}/delete", name="mdp_delete")
     */
    public function deleteAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('LFSMAdminBundle:Mdp')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Mdp entity.');
        }

        $em->remove($entity);
        $em->flush();


        return $this->redirect($this->generateUrl('mdp'));
    }

}
