<?php

namespace LFSM\DonateurBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * DateMontantFilter
 *
 * @ORM\Table(name="date_montant_filter")
 * @ORM\Entity(repositoryClass="LFSM\DonateurBundle\Repository\DateMontantFilterRepository")
 */
class DateMontantFilter
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
     * @ORM\Column(name="date_debut", type="date")
     */
    private $dateDebut;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_fin", type="date")
     */
    private $dateFin;

    /**
     * @var integer
     *
     * @ORM\Column(name="montant_min", type="integer")
     */
    private $montantMin;

    /**
     * @var integer
     *
     * @ORM\Column(name="montant_max", type="integer")
     */
    private $montantMax;


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
     * Set dateDebut
     *
     * @param \DateTime $dateDebut
     * @return DateMontantFilter
     */
    public function setDateDebut($dateDebut)
    {
        $this->dateDebut = $dateDebut;
    
        return $this;
    }

    /**
     * Get dateDebut
     *
     * @return \DateTime 
     */
    public function getDateDebut()
    {
        return $this->dateDebut;
    }

    /**
     * Set dateFin
     *
     * @param \DateTime $dateFin
     * @return DateMontantFilter
     */
    public function setDateFin($dateFin)
    {
        $this->dateFin = $dateFin;
    
        return $this;
    }

    /**
     * Get dateFin
     *
     * @return \DateTime 
     */
    public function getDateFin()
    {
        return $this->dateFin;
    }

    /**
     * Set montantMin
     *
     * @param integer $montantMin
     * @return DateMontantFilter
     */
    public function setMontantMin($montantMin)
    {
        $this->montantMin = $montantMin;
    
        return $this;
    }

    /**
     * Get montantMin
     *
     * @return integer 
     */
    public function getMontantMin()
    {
        return $this->montantMin;
    }

    /**
     * Set montantMax
     *
     * @param integer $montantMax
     * @return DateMontantFilter
     */
    public function setMontantMax($montantMax)
    {
        $this->montantMax = $montantMax;
    
        return $this;
    }

    /**
     * Get montantMax
     *
     * @return integer 
     */
    public function getMontantMax()
    {
        return $this->montantMax;
    }
}
