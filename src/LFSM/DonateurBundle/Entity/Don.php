<?php

namespace LFSM\DonateurBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Don
 *
 * @ORM\Table(name="don")
 * @ORM\Entity(repositoryClass="LFSM\DonateurBundle\Repository\DonRepository")
 */
class Don
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
     * @var \DateTime
     *
     * @ORM\Column(name="date_don", type="date", nullable=false)
     */
    private $dateDon;

    /**
     * @var string
     *
     * @ORM\Column(name="montant", type="decimal", nullable=false)
     */
    private $montant;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_remise_don", type="date", nullable=false)
     */
    private $dateRemiseDon;

    /**
     * @var string
     *
     * @ORM\Column(name="num_cheque", type="string", length=255, nullable=true)
     */
    private $numCheque;

    /**
     * @var string
     *
     * @ORM\Column(name="banque", type="string", length=255, nullable=true)
     */
    private $banque;
    
     /**
     * @ORM\ManyToOne(targetEntity="LFSM\AdminBundle\Entity\Mdp")
     * @ORM\JoinColumn(name="mdp_id", referencedColumnName="id", nullable=false)
     */
    private $mdp;
    
     /**
     * @ORM\ManyToOne(targetEntity="LFSM\AdminBundle\Entity\Action")
     * @ORM\JoinColumn(name="action_id", referencedColumnName="id", nullable=true)
     */
    private $action;
    
     /**
     * @ORM\ManyToOne(targetEntity="LFSM\DonateurBundle\Entity\Donateur", inversedBy="dons")
     * @ORM\JoinColumn(name="donateur_id", referencedColumnName="id", nullable=false)
     */
    private $donateur;


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
     * Set dateDon
     *
     * @param \DateTime $dateDon
     * @return Don
     */
    public function setDateDon($dateDon)
    {
        $this->dateDon = $dateDon;

        return $this;
    }

    /**
     * Get dateDon
     *
     * @return \DateTime 
     */
    public function getDateDon()
    {
        return $this->dateDon;
    }

    /**
     * Set montant
     *
     * @param string $montant
     * @return Don
     */
    public function setMontant($montant)
    {
        $this->montant = $montant;

        return $this;
    }

    /**
     * Get montant
     *
     * @return string 
     */
    public function getMontant()
    {
        return $this->montant;
    }

    /**
     * Set dateRemiseDon
     *
     * @param \DateTime $dateRemiseDon
     * @return Don
     */
    public function setDateRemiseDon($dateRemiseDon)
    {
        $this->dateRemiseDon = $dateRemiseDon;

        return $this;
    }

    /**
     * Get dateRemiseDon
     *
     * @return \DateTime 
     */
    public function getDateRemiseDon()
    {
        return $this->dateRemiseDon;
    }

    /**
     * Set numCheque
     *
     * @param string $numCheque
     * @return Don
     */
    public function setNumCheque($numCheque)
    {
        $this->numCheque = $numCheque;

        return $this;
    }

    /**
     * Get numCheque
     *
     * @return string 
     */
    public function getNumCheque()
    {
        return $this->numCheque;
    }

    /**
     * Set banque
     *
     * @param string $banque
     * @return Don
     */
    public function setBanque($banque)
    {
        $this->banque = $banque;

        return $this;
    }

    /**
     * Get banque
     *
     * @return string 
     */
    public function getBanque()
    {
        return $this->banque;
    }

    /**
     * Set mdp
     *
     * @param \LFSM\AdminBundle\Entity\Mdp $mdp
     * @return Don
     */
    public function setMdp(\LFSM\AdminBundle\Entity\Mdp $mdp)
    {
        $this->mdp = $mdp;

        return $this;
    }

    /**
     * Get mdp
     *
     * @return \LFSM\AdminBundle\Entity\Mdp 
     */
    public function getMdp()
    {
        return $this->mdp;
    }

    /**
     * Set action
     *
     * @param \LFSM\AdminBundle\Entity\Action $action
     * @return Don
     */
    public function setAction(\LFSM\AdminBundle\Entity\Action $action = null)
    {
        $this->action = $action;

        return $this;
    }

    /**
     * Get action
     *
     * @return \LFSM\AdminBundle\Entity\Action 
     */
    public function getAction()
    {
        return $this->action;
    }

    /**
     * Set donateur
     *
     * @param \LFSM\DonateurBundle\Entity\Donateur $donateur
     * @return Don
     */
    public function setDonateur(\LFSM\DonateurBundle\Entity\Donateur $donateur)
    {
        $this->donateur = $donateur;

        return $this;
    }

    /**
     * Get donateur
     *
     * @return \LFSM\DonateurBundle\Entity\Donateur 
     */
    public function getDonateur()
    {
        return $this->donateur;
    }
}
