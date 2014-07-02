<?php

namespace LFSM\AdminBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use LFSM\AdminBundle\Entity\RefProvenanceFichier;
use LFSM\AdminBundle\Form\RefProvenanceFichierType;

/**
 * RefProvenanceFichier controller.
 *
 * @Route("/refprovenancefichier")
 */
class RefProvenanceFichierController extends Controller {

    /**
     * Lists all RefProvenanceFichier entities.
     *
     * @Route("/", name="refprovenancefichier")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $query = $em->getRepository('LFSMAdminBundle:RefProvenanceFichier')->myFindAllQuery();

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
     * Displays a form to create a new RefProvenanceFichier entity.
     *
     * @Route("/new", name="refprovenancefichier_new")
     * @Template()
     */
    public function newAction()
    {
        $entity = new RefProvenanceFichier();
        $form = $this->createForm(new RefProvenanceFichierType(), $entity);

        return array(
            'entity' => $entity,
            'form' => $form->createView(),
        );
    }

    /**
     * Creates a new RefProvenanceFichier entity.
     *
     * @Route("/create", name="refprovenancefichier_create")
     * @Method("POST")
     * @Template("LFSMAdminBundle:RefProvenanceFichier:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new RefProvenanceFichier();
        $form = $this->createForm(new RefProvenanceFichierType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('refprovenancefichier', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form' => $form->createView(),
        );
    }

    /**
     * Displays a form to edit an existing RefProvenanceFichier entity.
     *
     * @Route("/{id}/edit", name="refprovenancefichier_edit")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('LFSMAdminBundle:RefProvenanceFichier')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find RefProvenanceFichier entity.');
        }

        $editForm = $this->createForm(new RefProvenanceFichierType(), $entity);

        return array(
            'entity' => $entity,
            'edit_form' => $editForm->createView()
        );
    }

    /**
     * Edits an existing RefProvenanceFichier entity.
     *
     * @Route("/{id}/update", name="refprovenancefichier_update")
     * @Method("POST")
     * @Template("LFSMAdminBundle:RefProvenanceFichier:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('LFSMAdminBundle:RefProvenanceFichier')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find RefProvenanceFichier entity.');
        }

        $editForm = $this->createForm(new RefProvenanceFichierType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('refprovenancefichier', array('id' => $id)));
        }

        return array(
            'entity' => $entity,
            'edit_form' => $editForm->createView()
        );
    }

    /**
     * Deletes a RefProvenanceFichier entity.
     *
     * @Route("/{id}/delete", name="refprovenancefichier_delete")
     */
    public function deleteAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('LFSMAdminBundle:RefProvenanceFichier')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find RefProvenanceFichier entity.');
        }

        $em->remove($entity);
        $em->flush();


        return $this->redirect($this->generateUrl('refprovenancefichier'));
    }

}
