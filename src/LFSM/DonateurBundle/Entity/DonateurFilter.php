<?php

namespace LFSM\DonateurBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Donateur
 *
 * @ORM\Table(name="donateur_filter")
 * @ORM\Entity(repositoryClass="LFSM\DonateurBundle\Repository\DonateurFilterRepository")
 */
class DonateurFilter
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="raison_sociale", type="string", length=255, nullable=true)
     */
    private $rs;
    
    /**
     * @ORM\ManyToOne(targetEntity="LFSM\AdminBundle\Entity\Civilite")
     * @ORM\JoinColumn(name="civilite_id", referencedColumnName="id", nullable=false)
     */
    private $civilite;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=255, nullable=true)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="prenom", type="string", length=255, nullable=true)
     */
    private $prenom;

    /**
     * @var integer
     *
     * @ORM\Column(name="cp", type="string", length=5, nullable=true)
     */
    private $cp;

    /**
     * @var string
     *
     * @ORM\Column(name="ville", type="string", length=255, nullable=true)
     */
    private $ville;
    
     /**
     * @ORM\ManyToOne(targetEntity="LFSM\AdminBundle\Entity\Etat")
     * @ORM\JoinColumn(name="etat_id", referencedColumnName="id", nullable=true)
     */
    private $etat;
    
    /**
     * @ORM\ManyToOne(targetEntity="LFSM\AdminBundle\Entity\Statut")
     * @ORM\JoinColumn(name="statut_id", referencedColumnName="id", nullable=true)
     */
    private $statut;
    
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="birthday", type="date", nullable=true)
     */
    private $birthday;
    
    /**
     * @var string
     *
     * @ORM\Column(name="nombre_enfants", type="string", nullable=true)
     */
    protected $nombreEnfants;
    
     /**
     * @ORM\ManyToOne(targetEntity="LFSM\AdminBundle\Entity\StatutSocial")
     * @ORM\JoinColumn(name="statut_social_id", referencedColumnName="id", nullable=true)
     */
    private $statutSocial;
    
    /**
     * @var boolean
     *
     * @ORM\Column(name="has_email", type="boolean", nullable=true)
     */
    private $hasEmail;
    
    /**
     * @var boolean
     *
     * @ORM\Column(name="has_phone_number", type="boolean", nullable=true)
     */
    private $hasPhoneNumber;
    
     /**
     * @ORM\ManyToOne(targetEntity="LFSM\AdminBundle\Entity\Mdp")
     * @ORM\JoinColumn(name="mdp_id", referencedColumnName="id", nullable=true)
     */
    private $modeDePaiement;
    
    /**
     * @var string
     *
     * @ORM\Column(name="nb_annees_fidelite", type="integer", nullable=true)
     */
    protected $nbAnneesFidelite;


    /**
     * Set id
     *
     * @param integer $id
     * @return DonateurFilter
     */
    public function setId($id)
    {
        $this->id = $id;
        
        return $this;
    }
    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set rs
     *
     * @param string $rs
     * @return DonateurFilter
     */
    public function setRs($rs)
    {
        $this->rs = $rs;
    
        return $this;
    }

    /**
     * Get rs
     *
     * @return string 
     */
    public function getRs()
    {
        return $this->rs;
    }
    
    /**
     * Set civilite
     *
     * @param \LFSM\AdminBundle\Entity\Civilite $civilite
     * @return Donateur
     */
    public function setCivilite(\LFSM\AdminBundle\Entity\Civilite $civilite)
    {
        $this->civilite = $civilite;
    
        return $this;
    }

    /**
     * Get civilite
     *
     * @return \LFSM\AdminBundle\Entity\Civilite 
     */
    public function getCivilite()
    {
        return $this->civilite;
    }

    /**
     * Set nom
     *
     * @param string $nom
     * @return DonateurFilter
     */
    public function setNom($nom)
    {
        $this->nom = $nom;
    
        return $this;
    }

    /**
     * Get nom
     *
     * @return string 
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set prenom
     *
     * @param string $prenom
     * @return DonateurFilter
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;
    
        return $this;
    }

    /**
     * Get prenom
     *
     * @return string 
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * Set cp
     *
     * @param string $cp
     * @return DonateurFilter
     */
    public function setCp($cp)
    {
        $this->cp = $cp;
    
        return $this;
    }

    /**
     * Get cp
     *
     * @return string 
     */
    public function getCp()
    {
        return $this->cp;
    }

    /**
     * Set ville
     *
     * @param string $ville
     * @return DonateurFilter
     */
    public function setVille($ville)
    {
        $this->ville = $ville;
    
        return $this;
    }

    /**
     * Get ville
     *
     * @return string 
     */
    public function getVille()
    {
        return $this->ville;
    }

    /**
     * Set etat
     *
     * @param \LFSM\AdminBundle\Entity\Etat $etat
     * @return DonateurFilter
     */
    public function setEtat(\LFSM\AdminBundle\Entity\Etat $etat)
    {
        $this->etat = $etat;
    
        return $this;
    }

    /**
     * Get etat
     *
     * @return \LFSM\AdminBundle\Entity\Etat 
     */
    public function getEtat()
    {
        return $this->etat;
    }

    /**
     * Set statut
     *
     * @param \LFSM\AdminBundle\Entity\Statut $statut
     * @return DonateurFilter
     */
    public function setStatut(\LFSM\AdminBundle\Entity\Statut $statut)
    {
        $this->statut = $statut;
    
        return $this;
    }

    /**
     * Get statut
     *
     * @return \LFSM\AdminBundle\Entity\Statut 
     */
    public function getStatut()
    {
        return $this->statut;
    }
    
    /**
     * Set birthday
     *
     * @param \DateTime $birthday
     * @return Donateur
     */
    public function setBirthday($birthday)
    {
        $this->birthday = $birthday;
    
        return $this;
    }

    /**
     * Get birthday
     *
     * @return \DateTime 
     */
    public function getBirthday()
    {
        return $this->birthday;
    }

    /**
     * Set nombreEnfants
     *
     * @param string $nombreEnfants
     * @return DonateurFilter
     */
    public function setNombreEnfants($nombreEnfants)
    {
        $this->nombreEnfants = $nombreEnfants;

        return $this;
    }

    /**
     * Get nombreEnfants
     *
     * @return string 
     */
    public function getNombreEnfants()
    {
        return $this->nombreEnfants;
    }

    /**
     * Set statutSocial
     *
     * @param \LFSM\AdminBundle\Entity\StatutSocial $statutSocial
     * @return DonateurFilter
     */
    public function setStatutSocial(\LFSM\AdminBundle\Entity\StatutSocial $statutSocial = null)
    {
        $this->statutSocial = $statutSocial;

        return $this;
    }

    /**
     * Get statutSocial
     *
     * @return \LFSM\AdminBundle\Entity\StatutSocial 
     */
    public function getStatutSocial()
    {
        return $this->statutSocial;
    }

    /**
     * Set hasEmail
     *
     * @param boolean $hasEmail
     * @return DonateurFilter
     */
    public function setHasEmail($hasEmail)
    {
        $this->hasEmail = $hasEmail;

        return $this;
    }

    /**
     * Get hasEmail
     *
     * @return boolean 
     */
    public function getHasEmail()
    {
        return $this->hasEmail;
    }

    /**
     * Set hasPhoneNumber
     *
     * @param boolean $hasPhoneNumber
     * @return DonateurFilter
     */
    public function setHasPhoneNumber($hasPhoneNumber)
    {
        $this->hasPhoneNumber = $hasPhoneNumber;

        return $this;
    }

    /**
     * Get hasPhoneNumber
     *
     * @return boolean 
     */
    public function getHasPhoneNumber()
    {
        return $this->hasPhoneNumber;
    }
    
    /**
     * Set modeDePaiement
     *
     * @param \LFSM\AdminBundle\Entity\Mdp $modeDePaiement
     * @return Donateur
     */
    public function setModeDePaiement(\LFSM\AdminBundle\Entity\Mdp $modeDePaiement = null)
    {
        $this->modeDePaiement = $modeDePaiement;

        return $this;
    }

    /**
     * Get modeDePaiement
     *
     * @return \LFSM\AdminBundle\Entity\Mdp
     */
    public function getModeDePaiement()
    {
        return $this->modeDePaiement;
    }

    /**
     * Set nbAnneesFidelite
     *
     * @param integer $nbAnneesFidelite
     * @return DonateurFilter
     */
    public function setNbAnneesFidelite($nbAnneesFidelite)
    {
        $this->nbAnneesFidelite = $nbAnneesFidelite;

        return $this;
    }

    /**
     * Get nbAnneesFidelite
     *
     * @return integer 
     */
    public function getNbAnneesFidelite()
    {
        return $this->nbAnneesFidelite;
    }
}
