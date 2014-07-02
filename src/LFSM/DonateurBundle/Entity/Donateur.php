<?php

namespace LFSM\DonateurBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Index;

/**
 * Donateur
 *
 * @ORM\Table(name="donateur",indexes={@index(name="donateur_idx", columns={"birthday", "date_dernier_don"})})
 * @ORM\Entity(repositoryClass="LFSM\DonateurBundle\Repository\DonateurRepository")
 */
class Donateur
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

//    /**
//     * @var string
//     *
//     * @ORM\Column(name="khis", type="string", length=10, nullable=true)
//     */
//    private $khis;

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
     * @ORM\Column(name="nom", type="string", length=255, nullable=false)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="prenom", type="string", length=255, nullable=false)
     */
    private $prenom;

    /**
     * @var string
     *
     * @ORM\Column(name="adresse", type="string", length=255, nullable=false)
     */
    private $adresse;
    
    /**
     * @var string
     *
     * @ORM\Column(name="adresse_complementaire", type="string", length=255, nullable=true)
     */
    private $adresseComplementaire;
    
     /**
     * @var string
     *
     * @ORM\Column(name="lieu_dit", type="string", length=255, nullable=true)
     */
    private $lieuDit;

    /**
     * @var string
     *
     * @ORM\Column(name="bp", type="string", length=25, nullable=true)
     */
    private $bp;

    /**
     * @var integer
     *
     * @ORM\Column(name="cp", type="string", length=5, nullable=false)
     */
    private $cp;

    /**
     * @var string
     *
     * @ORM\Column(name="ville", type="string", length=255, nullable=false)
     */
    private $ville;

    /**
     * @var string
     *
     * @ORM\Column(name="tel_prm", type="string", length=10, nullable=true)
     */
    private $telPrm;

    /**
     * @var string
     *
     * @ORM\Column(name="tel_sec", type="string", length=10, nullable=true)
     */
    private $telSec;

    /**
     * @var string
     *
     * @ORM\Column(name="tel_ptb", type="string", length=10, nullable=true)
     */
    private $telPtb;

    /**
     * @var string
     *
     * @ORM\Column(name="fax", type="string", length=10, nullable=true)
     */
    private $fax;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="birthday", type="date", nullable=false)
     */
    private $birthday;
    
     /**
     * @ORM\ManyToOne(targetEntity="LFSM\AdminBundle\Entity\Etat")
     * @ORM\JoinColumn(name="etat_id", referencedColumnName="id", nullable=true)
     */
    private $etat;
    
     /**
     * @ORM\ManyToOne(targetEntity="LFSM\AdminBundle\Entity\Fonction")
     * @ORM\JoinColumn(name="fonction_id", referencedColumnName="id", nullable=true)
     */
    private $fonction;
    
    /**
     * @ORM\ManyToOne(targetEntity="LFSM\AdminBundle\Entity\Statut")
     * @ORM\JoinColumn(name="statut_id", referencedColumnName="id", nullable=true)
     */
    private $statut;
    
    /**
     * @ORM\ManyToOne(targetEntity="LFSM\AdminBundle\Entity\StatutSocial")
     * @ORM\JoinColumn(name="statut_social_id", referencedColumnName="id", nullable=true)
     */
    private $statutSocial;

    /**
     * @var boolean
     *
     * @ORM\Column(name="indice_t", type="boolean", nullable=true)
     */
    private $indice_t;

    /**
     * @var boolean
     *
     * @ORM\Column(name="promesse", type="boolean", nullable=true)
     */
    private $promesse;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255, nullable=true)
     */
    private $email;
    
    /**
     * @ORM\ManyToOne(targetEntity="LFSM\DonateurBundle\Entity\Don")
     * @ORM\JoinColumn(name="dernier_don_id", referencedColumnName="id", nullable=true)
     */
    private $dernierDon;
    
     /**
     * @var string
     *
     * @ORM\Column(name="date_dernier_don", type="date", length=255, nullable=true)
     */
    private $dateDernierDon;
    
    /**
     * @var string
     *
     * @ORM\Column(name="nombre_enfants", type="string", nullable=true)
     */
    protected $nombreEnfants;
    
    /**
    * @ORM\OneToMany(targetEntity="LFSM\DonateurBundle\Entity\Don", mappedBy="donateur", cascade={"persist"})
    */
    private $dons;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }
//
//    /**
//     * Set khis
//     *
//     * @param string $khis
//     * @return Donateur
//     */
//    public function setKhis($khis)
//    {
//        $this->khis = $khis;
//    
//        return $this;
//    }
//
//    /**
//     * Get khis
//     *
//     * @return string 
//     */
//    public function getKhis()
//    {
//        return $this->khis;
//    }

    /**
     * Set rs
     *
     * @param string $rs
     * @return Donateur
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
     * Set nom
     *
     * @param string $nom
     * @return Donateur
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
     * @return Donateur
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
     * Set adresse
     *
     * @param string $adresse
     * @return Donateur
     */
    public function setAdresse($adresse)
    {
        $this->adresse = $adresse;
    
        return $this;
    }

    /**
     * Get adresse
     *
     * @return string 
     */
    public function getAdresse()
    {
        return $this->adresse;
    }

    /**
     * Set bp
     *
     * @param string $bp
     * @return Donateur
     */
    public function setBp($bp)
    {
        $this->bp = $bp;
    
        return $this;
    }

    /**
     * Get bp
     *
     * @return string 
     */
    public function getBp()
    {
        return $this->bp;
    }

    /**
     * Set cp
     *
     * @param string $cp
     * @return Donateur
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
     * @return Donateur
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
     * Set telPrm
     *
     * @param string $telPrm
     * @return Donateur
     */
    public function setTelPrm($telPrm)
    {
        $this->telPrm = $telPrm;
    
        return $this;
    }

    /**
     * Get telPrm
     *
     * @return string 
     */
    public function getTelPrm()
    {
        return $this->telPrm;
    }

    /**
     * Set telSec
     *
     * @param string $telSec
     * @return Donateur
     */
    public function setTelSec($telSec)
    {
        $this->telSec = $telSec;
    
        return $this;
    }

    /**
     * Get telSec
     *
     * @return string 
     */
    public function getTelSec()
    {
        return $this->telSec;
    }

    /**
     * Set telPtb
     *
     * @param string $telPtb
     * @return Donateur
     */
    public function setTelPtb($telPtb)
    {
        $this->telPtb = $telPtb;
    
        return $this;
    }

    /**
     * Get telPtb
     *
     * @return string 
     */
    public function getTelPtb()
    {
        return $this->telPtb;
    }

    /**
     * Set fax
     *
     * @param string $fax
     * @return Donateur
     */
    public function setFax($fax)
    {
        $this->fax = $fax;
    
        return $this;
    }

    /**
     * Get fax
     *
     * @return string 
     */
    public function getFax()
    {
        return $this->fax;
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
     * Set indice_t
     *
     * @param boolean $indiceT
     * @return Donateur
     */
    public function setIndiceT($indiceT)
    {
        $this->indice_t = $indiceT;
    
        return $this;
    }

    /**
     * Get indice_t
     *
     * @return boolean 
     */
    public function getIndiceT()
    {
        return $this->indice_t;
    }

    /**
     * Set promesse
     *
     * @param boolean $promesse
     * @return Donateur
     */
    public function setPromesse($promesse)
    {
        $this->promesse = $promesse;
    
        return $this;
    }

    /**
     * Get promesse
     *
     * @return boolean 
     */
    public function getPromesse()
    {
        return $this->promesse;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return Donateur
     */
    public function setEmail($email)
    {
        $this->email = $email;
    
        return $this;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
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
     * Set etat
     *
     * @param \LFSM\AdminBundle\Entity\Etat $etat
     * @return Donateur
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
     * Set fonction
     *
     * @param \LFSM\AdminBundle\Entity\Fonction $fonction
     * @return Donateur
     */
    public function setFonction(\LFSM\AdminBundle\Entity\Fonction $fonction)
    {
        $this->fonction = $fonction;
    
        return $this;
    }

    /**
     * Get fonction
     *
     * @return \LFSM\AdminBundle\Entity\Fonction 
     */
    public function getFonction()
    {
        return $this->fonction;
    }

    /**
     * Set statut
     *
     * @param \LFSM\AdminBundle\Entity\Statut $statut
     * @return Donateur
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
    
    public function getFirstDonation($donsParDonateur){
        return end($donsParDonateur);
    }
    
    public function getDonsArray($donsParDonateur){
        $donArray = array();
        
        foreach($donsParDonateur as $don){
            $donArray[] =  $don->getMontant();
        }
        
        return $donArray;
    }
    
    public function getDonsCumules($donArray){
        $montant = 0;
        
        foreach($donArray as $don){
            $montant +=  $don;
        }
        
        return $montant;
    }
    
    public function isDonateurActif($em, $nbYears){
        return ('2' == array_sum($this->donationForTheLastXYears($em, $nbYears)));
    }

    /**
     * Set dateDernierDon
     *
     * @param \DateTime $dateDernierDon
     * @return Donateur
     */
    public function setDateDernierDon($dateDernierDon)
    {
        $this->dateDernierDon = $dateDernierDon;

        return $this;
    }

    /**
     * Get dateDernierDon
     *
     * @return \DateTime 
     */
    public function getDateDernierDon()
    {
        return $this->dateDernierDon;
    }

    /**
     * Set dernierDon
     *
     * @param \LFSM\DonateurBundle\Entity\Don $dernierDon
     * @return Donateur
     */
    public function setDernierDon(\LFSM\DonateurBundle\Entity\Don $dernierDon = null)
    {
        $this->dernierDon = $dernierDon;

        return $this;
    }

    /**
     * Get dernierDon
     *
     * @return \LFSM\DonateurBundle\Entity\Don 
     */
    public function getDernierDon()
    {
        return $this->dernierDon;
    }

    /**
     * Set nombreEnfants
     *
     * @param string $nombreEnfants
     * @return Donateur
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
     * @return Donateur
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
     * Constructor
     */
    public function __construct()
    {
        $this->dons = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add dons
     *
     * @param \LFSM\DonateurBundle\Entity\Don $dons
     * @return Donateur
     */
    public function addDon(\LFSM\DonateurBundle\Entity\Don $dons)
    {
        $this->dons[] = $dons;

        return $this;
    }

    /**
     * Remove dons
     *
     * @param \LFSM\DonateurBundle\Entity\Don $dons
     */
    public function removeDon(\LFSM\DonateurBundle\Entity\Don $dons)
    {
        $this->dons->removeElement($dons);
    }

    /**
     * Get dons
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getDons()
    {
        return $this->dons;
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
    
    public function donationForTheLastXYears($em, $nbYears){
        if (!$this) {
            throw $this->createNotFoundException('Unable to find Entity donateur.');
        }
        
        $dateTimeXYearsAgo = new \DateTime('-'. $nbYears .' year');
        $a_years_dons = array();
        
        for ($i = $dateTimeXYearsAgo->format('Y'); $i <= date('Y'); $i++){
            $b_hasDonatedForThisYear = $em->getRepository('LFSMDonateurBundle:Don')->hasDonatedThisYear($this, (int)$i);
            $a_years_dons[$i] = (int)$b_hasDonatedForThisYear;
        }
        
        return $a_years_dons;
    }

    /**
     * Set adresseComplementaire
     *
     * @param string $adresseComplementaire
     * @return Donateur
     */
    public function setAdresseComplementaire($adresseComplementaire)
    {
        $this->adresseComplementaire = $adresseComplementaire;
    
        return $this;
    }

    /**
     * Get adresseComplementaire
     *
     * @return string 
     */
    public function getAdresseComplementaire()
    {
        return $this->adresseComplementaire;
    }

    /**
     * Set lieuDit
     *
     * @param string $lieuDit
     * @return Donateur
     */
    public function setLieuDit($lieuDit)
    {
        $this->lieuDit = $lieuDit;
    
        return $this;
    }

    /**
     * Get lieuDit
     *
     * @return string 
     */
    public function getLieuDit()
    {
        return $this->lieuDit;
    }
}