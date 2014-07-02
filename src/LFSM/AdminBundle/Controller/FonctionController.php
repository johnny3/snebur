<?php

namespace LFSM\AdminBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use LFSM\AdminBundle\Entity\Fonction;
use LFSM\AdminBundle\Form\FonctionType;

/**
 * Fonction controller.
 *
 * @Route("/fonction")
 */
class FonctionController extends Controller
{
    /**
     * Lists all Fonction entities.
     *
     * @Route("/", name="fonction")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $query = $em->getRepository('LFSMAdminBundle:Fonction')->myFindAllQuery();
        
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
     * Displays a form to create a new Fonction entity.
     *
     * @Route("/new", name="fonction_new")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Fonction();
        $form   = $this->createForm(new FonctionType(), $entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a new Fonction entity.
     *
     * @Route("/create", name="fonction_create")
     * @Method("POST")
     * @Template("LFSMAdminBundle:Fonction:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity  = new Fonction();
        $form = $this->createForm(new FonctionType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('fonction', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Fonction entity.
     *
     * @Route("/{id}/edit", name="fonction_edit")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('LFSMAdminBundle:Fonction')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Fonction entity.');
        }

        $editForm = $this->createForm(new FonctionType(), $entity);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView()
        );
    }

    /**
     * Edits an existing Fonction entity.
     *
     * @Route("/{id}/update", name="fonction_update")
     * @Method("POST")
     * @Template("LFSMAdminBundle:Fonction:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('LFSMAdminBundle:Fonction')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Fonction entity.');
        }

        $editForm = $this->createForm(new FonctionType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('fonction', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView()
        );
    }

    /**
     * Deletes a Fonction entity.
     *
     * @Route("/{id}/delete", name="fonction_delete")
     */
    public function deleteAction($id)
    {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('LFSMAdminBundle:Fonction')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Fonction entity.');
            }

            $em->remove($entity);
            $em->flush();

        return $this->redirect($this->generateUrl('fonction'));
    }
}
