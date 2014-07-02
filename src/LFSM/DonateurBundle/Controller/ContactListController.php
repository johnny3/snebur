<?php

namespace LFSM\DonateurBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use LFSM\DonateurBundle\Entity\Donateur;
use LFSM\DonateurBundle\Form\DonateurType;
use LFSM\DonateurBundle\Entity\DonateurFilter;
use LFSM\DonateurBundle\Form\DonateurFilterType;
use LFSM\DonateurBundle\Entity\ContactDonFilter;
use LFSM\DonateurBundle\Form\ContactDonFilterType;
use LFSM\DonateurBundle\Entity\DateMontantFilter;
use LFSM\DonateurBundle\Form\DateMontantFilterType;

/**
 * Lists controller.
 *
 * @Route("/contact-listes")
 */
class ContactListController extends Controller {

    /**
     * Lists all Lists entities.
     *
     * @Route("/", name="contact_listes")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        
        $listes = $em->getRepository('LFSMAdminBundle:Liste')->findAll();
        
        $contactDonFilter = new ContactDonFilter();
        $form1 = $this->createForm(new ContactDonFilterType(), $contactDonFilter);
        $dateMontantFilter = new DateMontantFilter();
        $form2 = $this->createForm(new DateMontantFilterType(), $dateMontantFilter);
        
        return array(
            'listes' => $listes,
            'form1' => $form1->createView(),
            'form2' => $form2->createView(),
        );
    }
    
     /**
     * Lists all Donateurs.
     *
     * @Route("/liste-donateurs", name="donateur_list")
     * @Template()
     */
    public function listAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        
        $getParameters = $request->query->all();
        
        if (isset($getParameters['liste']) && !is_null($getParameters['liste'])){
            if (isset($getParameters['sort']) && !empty($getParameters['sort']) && isset($getParameters['direction']) && !empty($getParameters['direction'])){
                $sort['sort'] = $getParameters['sort'];
                $sort['direction'] = $getParameters['direction'];
                $sort['page'] = $getParameters['page'];
            }
            else {
                $sort = NULL;
            }
            
            $etats = $em->getRepository('LFSMAdminBundle:Liste')->find($getParameters['liste'])->getEtat();
            
            foreach ($etats as $etat){
                $etat_liste_array[] =  $etat->getId();
            }
            $etat_liste = implode('-', $etat_liste_array);
            $dataArray = array('etat' => $etat_liste, 'sort' => $sort['sort'], 'direction' => $sort['direction'], 'page' => $sort['page']);
            $query = $em->getRepository('LFSMDonateurBundle:Donateur')->getDonateursByEtatIndiceTPromesseList($dataArray);
        }
        else {
            $query = $em->getRepository('LFSMDonateurBundle:Donateur')->getDonateursByEtatIndiceTPromesseList($request->query->all());
        }
        
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
