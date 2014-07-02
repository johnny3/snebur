<?php

namespace LFSM\AdminBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * Action controller.
 *
 * @Route("/")
 */
class AdminController extends Controller {

    /**
     * Lists all Action entities.
     *
     * @Route("/", name="admin")
     * @Template()
     */
    public function indexAction()
    {
        $menu = array(
            'Utilisateurs' => 'user_list',
            'Civilités' => 'civilite',
            'Statut' => 'statut',
            'Statut social' => 'statutsocial',
            'Fonctions' => 'fonction',
            'Mode de paiement' => 'mode_de_paiement',
            'Etats' => 'etat',
            'Thème des codes opération' => 'theme',
            'Code opération' => 'action',
            'Listes des donateurs' => 'liste',
        );
        
        
        return array('menu_items' => $menu);
    }

}
