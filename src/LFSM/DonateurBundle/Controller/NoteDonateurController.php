<?php

namespace LFSM\DonateurBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use LFSM\DonateurBundle\Entity\NoteDonateur;
use LFSM\DonateurBundle\Form\NoteDonateurType;

/**
 * NoteDonateur controller.
 *
 * @Route("/notedonateur")
 */
class NoteDonateurController extends Controller
{
    /**
     * Creates a new NoteDonateur entity.
     *
     * @Route("/create/{donateurId}", name="notedonateur_create")
     * @Method("POST")
     * @Template("LFSMDonateurBundle:NoteDonateur:new.html.twig")
     */
    public function createAction(Request $request, $donateurId)
    {
        $em = $this->getDoctrine()->getManager();
        $donateur = $em->getRepository('LFSMDonateurBundle:Donateur')->find($donateurId);
        
        $entity  = new NoteDonateur();
        $entity->setDate(new \DateTime('now'));
        $entity->setDonateur($donateur);
        $form = $this->createForm(new NoteDonateurType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('donateur_show', array('id' => $donateur->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }
    
    /**
     * Finds and displays a Don entity.
     *
     * @Route("/edit_note", name="note_donateur_edit_ajax")
     */
    public function noteDonateurEditAjaxAction(Request $request)
    {
        if ($request->isXmlHttpRequest()) {
            $em = $this->getDoctrine()->getManager();
            $noteIdValueForm = $request->request->get('noteId');
            
            $note = $em->getRepository('LFSMDonateurBundle:NoteDonateur')->find($noteIdValueForm);

            if (!$note) {
                throw $this->createNotFoundException('Unable to find NoteDonateur entity.');
            }

            $form_edit_note_donateur = $this->createForm(new NoteDonateurType(), $note);

            return new Response($this->renderView('LFSMDonateurBundle:NoteDonateur:editAjax.html.twig', array(
                            'note' => $note,
                            'form_edit_note_donateur' => $form_edit_note_donateur->createView()
                )));
        }
    }

    /**
     * Edits an existing NoteDonateur entity.
     *
     * @Route("/{id}/update", name="notedonateur_update")
     * @Method("POST")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        
        $donateurId = $request->request->get('donateurId');

        $note = $em->getRepository('LFSMDonateurBundle:NoteDonateur')->find($id);
        $donateur = $note->getDonateur();

        if (!$note) {
            throw $this->createNotFoundException('Unable to find NoteDonateur entity.');
        }

        $form_edit_note_donateur = $this->createForm(new NoteDonateurType(), $note);
        $form_edit_note_donateur->bind($request);

        if ($form_edit_note_donateur->isValid()) {
            $em->persist($note);
            $em->flush();

            return $this->redirect($this->generateUrl('donateur_show', array('id' => $donateur->getId())));
        }

        return array();
    }

    /**
     * Deletes a NoteDonateur entity.
     *
     * @Route("/{id}/delete", name="notedonateur_delete")
     * @Method("POST")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('LFSMDonateurBundle:NoteDonateur')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find NoteDonateur entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('notedonateur'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
