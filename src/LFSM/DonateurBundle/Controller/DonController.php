<?php

namespace LFSM\DonateurBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use LFSM\DonateurBundle\Entity\Don;
use LFSM\DonateurBundle\Entity\Donateur;
use LFSM\DonateurBundle\Form\DonType;

/**
 * Don controller.
 *
 * @Route("/don")
 */
class DonController extends Controller
{
    /**
     * Lists all Don entities.
     *
     * @Route("/", name="don")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('LFSMDonateurBundle:Don')->findAll();

        return array(
            'entities' => $entities,
        );
    }

    /**
     * Finds and displays a Don entity.
     *
     * @Route("/{id}/show", name="don_show")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('LFSMDonateurBundle:Don')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Don entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Finds and displays a Don entity.
     *
     * @Route("/detail_don", name="don_show_ajax")
     */
    public function showAjaxAction(Request $request)
    {
        if ($request->isXmlHttpRequest()) {
            $em = $this->getDoctrine()->getManager();
            $donIdValueForm = $request->request->get('donId');
            
            $don = $em->getRepository('LFSMDonateurBundle:Don')->find($donIdValueForm);
            
            return new Response($this->renderView('LFSMDonateurBundle:Don:showAjax.html.twig', array(
                            'don' => $don
                )));
        }
    }

    /**
     * Displays a form to create a new Don entity.
     *
     * @Route("/new", name="don_new")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Don();
        $form   = $this->createForm(new DonType(), $entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a new Don entity.
     *
     * @Route("/create/{donateurId}", name="don_create")
     * @Method("POST")
     */
    public function createAction(Request $request, $donateurId)
    {
        $em = $this->getDoctrine()->getManager();
        $donateur = $em->getRepository('LFSMDonateurBundle:Donateur')->find($donateurId);
        
        $don  = new Don();
        $don->setDonateur($donateur);
        $form = $this->createForm(new DonType(), $entity);
        $form->bind($request);
        
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($don);
            $em->flush();
            
            if ($don->getDateDon() > $donateur->getDateDernierDon()){
                $donateur->setDateDernierDon($don->getDateDon());
                $donateur->setDernierDon($don);
                $em->flush();
            }

            return $this->redirect($this->generateUrl('donateur_show', array('id' => $donateur->getId())));
        }
    }

    
    /**
     * Edits an existing Don entity
     *
     * @Route("/edit_don", name="don_edit_ajax")
     */
    public function editAjaxAction(Request $request)
    {
        if ($request->isXmlHttpRequest()) {
            $em = $this->getDoctrine()->getManager();
            $donIdValueForm = $request->request->get('donId');
            
            $don = $em->getRepository('LFSMDonateurBundle:Don')->find($donIdValueForm);
            $form_edit_don = $this->createForm(new DonType(), $don);
            
            return new Response($this->renderView('LFSMDonateurBundle:Don:editAjax.html.twig', array(
                            'don'           =>    $don,
                            'form_edit_don' =>    $form_edit_don->createView(),
                )));
        }
    }    

    /**
     * Edits an existing Don entity.
     *
     * @Route("/{id}/update", name="don_update")
     * @Method("POST")
     * @Template("LFSMDonateurBundle:Don:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $don = $em->getRepository('LFSMDonateurBundle:Don')->find($id);

        if (!$don) {
            throw $this->createNotFoundException('Unable to find Don entity.');
        }

        $editForm = $this->createForm(new DonType(), $don);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($don);
            $em->flush();
            
            $donateur = $em->getRepository('LFSMDonateurBundle:Donateur')->find($don->getDonateur()->getId());
            
            if ($don->getDateDon() > $donateur->getDateDernierDon()){
                $donateur->setDateDernierDon($don->getDateDon());
                $donateur->setDernierDon($don);
            }
            
            $em->flush();

            return $this->redirect($this->generateUrl('donateur_show', array('id' => $don->getDonateur()->getId())));
        }

        return array();
    }

    /**
     * Deletes a Don entity.
     *
     * @Route("/{id}/delete", name="don_delete")
     * @Method("POST")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('LFSMDonateurBundle:Don')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Don entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('don'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
    
    /**
     * Lists all Dons.
     *
     * @Route("/liste-dons-date-montant", name="don_filter_list")
     * @Template()
     */
    public function listDonsByDateAndMontantAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $session = $request->getSession();
        
        if ($request->isMethod('POST')) {
            $postParameters = current($request->request->all());
            unset($postParameters['_token']);
            $session->set('postParameters', $postParameters);
            $parameters = $session->get('postParameters');
        }
        elseif($request->isMethod('GET')){
            $getParameters = $request->query->all();
            $parameters = array_merge($session->get('postParameters'), $getParameters); // sinon les valeurs transmises en POST ne sont plus prises en compte
        }

        $query = $em->getRepository('LFSMDonateurBundle:Don')->findByDateAndAmount($parameters);

        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
                $query, $this->get('request')->query->get('page', 1)/* page number */, 10/* limit per page */
        );

        $totalPages = ceil($pagination->getTotalItemCount() / $pagination->getItemNumberPerPage());

        return array(
            'totalPages' => $totalPages,
            'pagination' => $pagination
        );
    }
}
