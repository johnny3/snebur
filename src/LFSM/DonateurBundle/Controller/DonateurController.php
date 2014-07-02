<?php

namespace LFSM\DonateurBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use LFSM\DonateurBundle\Entity\Donateur;
use LFSM\DonateurBundle\Entity\Don;
use LFSM\ToolBundle\Entity\Tools;
use LFSM\DonateurBundle\Entity\NoteDonateur;
use LFSM\DonateurBundle\Form\DonateurType;
use LFSM\DonateurBundle\Form\NoteDonateurType;
use LFSM\DonateurBundle\Form\DonType;
use LFSM\DonateurBundle\Entity\DonateurFilter;
use LFSM\DonateurBundle\Form\DonateurFilterType;

/**
 * Donateur controller.
 *
 * @Route("/")
 */
class DonateurController extends Controller {
//    /**
//     * Lists all Donateur entities.
//     *
//     * @Route("/populate")
//     * @Template("LFSMDonateurBundle:Donateur:index.html.twig")
//     */
//    public function populateAction()
//    {
//        $em = $this->getDoctrine()->getManager();
//
//        $civilite = $em->getRepository('LFSMAdminBundle:Civilite')->find(1);
//        $etat = $em->getRepository('LFSMAdminBundle:Etat')->find(1);
//        $statut = $em->getRepository('LFSMAdminBundle:Statut')->find(3);
//        $fonction = $em->getRepository('LFSMAdminBundle:Fonction')->find(2);
//        $provenanceFichier = $em->getRepository('LFSMAdminBundle:RefProvenanceFichier')->find(3);
//
//        for ($i = 0; $i < 30; $i++) {
//            $donateur = new Donateur();
//            $donateur->setNom('Nom Donateur ' . $i);
//            $donateur->setPrenom('Prénom Donateur ' . $i);
//            $donateur->setAdresse('Adresse Donateur ' . $i);
//            $donateur->setCp('93300');
//            $donateur->setVille('Ville Donateur ' . $i);
//            $donateur->setBirthday(new \DateTime('now'));
//            $donateur->setFonction($fonction);
//            $donateur->setCivilite($civilite);
//            $donateur->setEtat($etat);
//            $donateur->setCategorie($statut);
//            $donateur->setProvenanceFichier($provenanceFichier);
//            $em->persist($donateur);
//            $em->flush();
//        }
//
//        $query = $em->getRepository('LFSMDonateurBundle:Donateur')->findAll();
//
//        $paginator = $this->get('knp_paginator');
//        $pagination = $paginator->paginate(
//                $query, $this->get('request')->query->get('page', 1)/* page number */, 100/* limit per page */
//        );
//
//        $entity = new DonateurFilter();
//        $form = $this->createForm(new DonateurFilterType(), $entity);
//
//        return array(
//            'entities' => $pagination,
//            'entity' => $entity,
//            'form' => $form->createView(),
//        );
//    }

    /**
     * Lists all Donateur entities.
     *
     * @Route("/", name="donateur")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $orderBy = 'd.nom';
        $query = $em->getRepository('LFSMDonateurBundle:Donateur')->getDonateursByEtatStatutQuery($orderBy);

        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
                $query, $this->get('request')->query->get('page', 1)/* page number */, 10/* limit per page */
        );

        $entity = new DonateurFilter();
        $form = $this->createForm(new DonateurFilterType(), $entity);

        $totalPages = ceil($pagination->getTotalItemCount() / $pagination->getItemNumberPerPage());

        return array(
            'totalPages' => $totalPages,
            'pagination' => $pagination,
            'entity' => $entity,
            'form' => $form->createView(),
        );
    }

    /**
     * Searches all Donateur entities.
     *
     * @Route("/recherche_donateur", name="donateur_search")
     * @Template("LFSMDonateurBundle:Donateur:index.html.twig")
     */
    public function searchAction(Request $request)
    {
        $entity = new DonateurFilter();
        $form = $this->createForm(new DonateurFilterType(), $entity);
        $form->bind($request);
        $dataForm = $request->query->all();
        
        if (isset($dataForm['sort']) && !empty($dataForm['sort']) && isset($dataForm['direction']) && !empty($dataForm['direction'])){
            $sort['sort'] = $dataForm['sort'];
            $sort['direction'] = $dataForm['direction'];
        }
        else {
            $sort = NULL;
        }

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entities = $em->getRepository('LFSMDonateurBundle:Donateur')->getDonateursByParameters($em, $dataForm['lfsm_donateurbundle_donateurfiltertype'], $sort);
            
            $paginator = $this->get('knp_paginator');
            $pagination = $paginator->paginate(
                    $entities, $this->get('request')->query->get('page', 1)/* page number */, 10/* limit per page */
            );

            $currentPageNumber = $pagination->getCurrentPageNumber();
            $totalItemCount = $pagination->getTotalItemCount();
            $itemNumberPerPage = $pagination->getItemNumberPerPage();
            $totalPages = ceil($totalItemCount / $itemNumberPerPage);
        }

        if (!isset($currentPageNumber)) {
            $currentPageNumber = $request->query->get('page');
        }

        return array(
            'totalPages' => $totalPages,
            'pagination' => $pagination,
            'entity' => $entity,
            'form' => $form->createView(),
        );
    }

    /**
     * Finds and displays a Donateur entity.
     *
     * @Route("/donateur/{id}/show", name="donateur_show")
     * @Route("/donateur/{id}/show/{output}", requirements={"output" = "full|pdf"})
     */
    public function showAction($id, $output = null)
    {
        $em = $this->getDoctrine()->getManager();
        $template = 'LFSMDonateurBundle:Donateur:show.html.twig';
        $donateur = $em->getRepository('LFSMDonateurBundle:Donateur')->find($id);
        
        $donsByDonateurForTheLastTenYears = $donateur->donationForTheLastXYears($em, 10);
        
        $donsParDonateur = $em->getRepository('LFSMDonateurBundle:Don')->getDonsByDonateur($id);
        $notesParDonateur = $em->getRepository('LFSMDonateurBundle:NoteDonateur')->getNotesByDonateur($id);
        $lastDon = $donateur->getDernierDon();
        $firstDon = $donateur->getFirstDonation($donsParDonateur);
        $donArray = $donateur->getDonsArray($donsParDonateur);
        
        $nbDons = count($donArray);
        $montantDonCumules = $donateur->getDonsCumules($donArray);
        
        if (null != $lastDon){
            $donateurActif = $donateur->isDonateurActif($em, 1);
            $montantDonMoyen = $montantDonCumules/$nbDons;
        }
        else {
            $donateurActif = false;
            $montantDonMoyen = 0;
        }
        
        if (!empty($donArray)){
            $montantDonMax = max($donArray);
            $montantDonMin = min($donArray);
            $firstDonDate = $firstDon->getDateDon();
            $lastDonDate = $lastDon->getDateDon();
        }
        else {
            $montantDonMax = 0;
            $montantDonMin = 0;
            $firstDonDate = null;
            $lastDonDate = null;
        }
        
        $arrayDonateurDatas = array(
                                'donateur' => $donateur,
                                'donsParDonateur' => $donsParDonateur,
                                'notesParDonateur' => $notesParDonateur,
                                'lastDonDate' => $lastDonDate,
                                'firstDonDate' => $firstDonDate,
                                'nbDons' => $nbDons,
                                'montantDonCumules' => $montantDonCumules,
                                'montantDonMoyen' => $montantDonMoyen,
                                'montantDonMax' => $montantDonMax,
                                'montantDonMin' => $montantDonMin,
                                'donateurActif' => $donateurActif,
                                'donsParDonateurPourLesDixDernieresAnnees' => $donsByDonateurForTheLastTenYears
                            );
        
        $don = new Don();
        $form_new_don = $this->createForm(new DonType(), $don);
        
        $noteDonateur = new noteDonateur();
        $form_new_note_donateur = $this->createForm(new noteDonateurType($em, $donateur), $noteDonateur);

        $deleteForm = $this->createDeleteForm($id);
        
        $donateurFormsArray = array(
                                'form_new_don' => $form_new_don->createView(),
                                'form_new_note_donateur' => $form_new_note_donateur->createView(),
                                'delete_form' => $deleteForm->createView()
                        );
        
        $viewDataDonateurArray = array_merge($arrayDonateurDatas, $donateurFormsArray);
        
        if (null != $output){
           if ('full' == $output){
                return $this->container->get('templating')
                        ->renderResponse('LFSMDonateurBundle:Donateur:showFull.html.twig', $arrayDonateurDatas);
           }
           elseif ('pdf' == $output){
                return $this->createDonateurPdf($arrayDonateurDatas);
           } 
        }
        
        return $this->container->get('templating')
                        ->renderResponse($template, $viewDataDonateurArray);
    }
    
    private function createDonateurPdf($arrayDonateurDatas){
        $date = new \DateTime();
        $day = $date->format('d');
        $month = $date->format('m');
        $year = $date->format('Y');
        
        $dateArray = array('date'=> $date);
        
        $arrayDatas = array_merge($arrayDonateurDatas, $dateArray);

        $content = $this->renderView('LFSMDonateurBundle:Donateur:showPdf.html.twig',
                            $arrayDatas
        );

        try {
            $html2pdf = new \HTML2PDF('P', 'A4', 'fr');
            $html2pdf->pdf->SetDisplayMode('fullpage');
            $html2pdf->writeHTML($content);
            $html2pdf->Output('donateur-' . $day . '-' . $month. '-' . $year . '.pdf');
            exit;
        } catch (\HTML2PDF_exception $e) {
            echo $e;
            exit;
        }
    }

    /**
     * Displays a form to create a new Donateur entity.
     *
     * @Route("/donateur/new", name="donateur_new")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Donateur();
        $form = $this->createForm(new DonateurType(), $entity);

        return array(
            'entity' => $entity,
            'form' => $form->createView(),
        );
    }

    /**
     * Creates a new Donateur entity.
     *
     * @Route("/donateur/create", name="donateur_create")
     * @Method("POST")
     * @Template("LFSMDonateurBundle:Donateur:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Donateur();
        $form = $this->createForm(new DonateurType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('donateur_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form' => $form->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Donateur entity.
     *
     * @Route("/donateur/{id}/edit", name="donateur_edit")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('LFSMDonateurBundle:Donateur')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Donateur entity.');
        }

        $editForm = $this->createForm(new DonateurType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity' => $entity,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing Donateur entity.
     *
     * @Route("/donateur/{id}/update", name="donateur_update")
     * @Method("POST")
     * @Template("LFSMDonateurBundle:Donateur:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('LFSMDonateurBundle:Donateur')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Donateur entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new DonateurType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('donateur_show', array('id' => $id)));
        }

        return array(
            'entity' => $entity,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a Donateur entity.
     *
     * @Route("/donateur/{id}/delete", name="donateur_delete")
     * @Method("POST")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('LFSMDonateurBundle:Donateur')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Donateur entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('donateur'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
                        ->add('id', 'hidden')
                        ->getForm()
        ;
    }
    
     /**
     * Lists all Donateur entities.
     *
     * @Route("/export_csv", name="export_csv")
     */
    public function exportAction(Request $request)
    {
        $em = $this->getDoctrine()->getEntityManager();
        $dataForm = $request->query->all();
        
        if (!empty($dataForm)){
            if (isset($dataForm['sort']) && !empty($dataForm['sort']) && isset($dataForm['direction']) && !empty($dataForm['direction'])){
                $sort['sort']       = $dataForm['sort'];
                $sort['direction']  = $dataForm['direction'];
            }
            else {
                $sort = NULL;
            }

            $query = $em->getRepository('LFSMDonateurBundle:Donateur')->getDonateursByParameters($em, $dataForm['lfsm_donateurbundle_donateurfiltertype'], $sort);
        }
        else {
            $query = $em->getRepository('LFSMDonateurBundle:Donateur')->findAll();
        }
        $donateurTab = array();
        $headers = array('RS', 'CIVILITE', 'NOM', 'PRENOM', 'ADRESSE', 'BP', 'CP', 'VILLE', 'DATE DE NAISSANCE', 'ETAT', 'FONCTION', 'STATUT', 'NOMBRE D\'ENFANTS', 'EMAIL', 'FIXE', 'PORTABLE');
        $handle = fopen('php://memory', 'r+');
        fputcsv($handle, $headers, ';');
        unset($headers);
        
        foreach ($query as $i=>$donateur){
            $donateurTab[$i]['rs'] = mb_strtoupper(Tools::stripAccents($donateur->getRs()));
            $donateurTab[$i]['civilite'] = mb_strtoupper($donateur->getCivilite()->getCivLibCourt());
            $donateurTab[$i]['nom'] = mb_strtoupper($donateur->getNom());
            $donateurTab[$i]['prenom'] = mb_strtoupper(Tools::stripAccents($donateur->getPrenom()));
            $donateurTab[$i]['adresse'] = mb_strtoupper(Tools::stripAccents($donateur->getAdresse()));
            $donateurTab[$i]['bp'] = $donateur->getBp();
            $donateurTab[$i]['cp'] = $donateur->getCp();
            $donateurTab[$i]['ville'] = mb_strtoupper(Tools::stripAccents($donateur->getVille()));
            $donateurTab[$i]['dateNaissance'] = $donateur->getBirthday()->format('d/m/Y');
            $donateurTab[$i]['etat'] = mb_strtoupper(Tools::stripAccents($donateur->getEtat()->getEtatLib()));
            $donateurTab[$i]['fonction'] = mb_strtoupper(Tools::stripAccents($donateur->getFonction()->getFctLib()));
            $donateurTab[$i]['statut'] = mb_strtoupper(Tools::stripAccents($donateur->getStatut()->getStatutlib()));
            $donateurTab[$i]['NbEnfants'] = $donateur->getNombreEnfants();
            $donateurTab[$i]['email'] = $donateur->getEmail();
            $donateurTab[$i]['fixe'] = $donateur->getTelPrm();
            $donateurTab[$i]['portable'] = $donateur->getTelPtb();
            fputcsv($handle, $donateurTab[$i], ';');
            unset($donateurTab[$i]);
        }

        rewind($handle);
        $content = stream_get_contents($handle);
        
        fclose($handle);
        
        return new Response($content, 200, array(
            'Content-Type' => 'application/force-download',
            'Content-Disposition' => 'attachment; filename="export-donateur-'. date('d-m-Y') .'.csv"'
        ));
    }
    
     /**
     * Lists all Donateurs.
     *
     * @Route("/liste-donateurs-age-don", name="contact_don_filter_list")
     * @Template()
     */
    public function listDonateursByAgeAndLastDonAction(Request $request)
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

        $query = $em->getRepository('LFSMDonateurBundle:Donateur')->getDonateursByAgeAndLastDon($parameters);

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
