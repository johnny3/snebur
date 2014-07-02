<?php

namespace LFSM\DonateurBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * NoteDonateur
 *
 * @ORM\Table(name="note_donateur")
 * @ORM\Entity(repositoryClass="LFSM\DonateurBundle\Repository\NoteDonateurRepository")
 */
class NoteDonateur
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
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;

    /**
     * @var string
     *
     * @ORM\Column(name="titre", type="string", length=255)
     */
    private $titre;

    /**
     * @var string
     *
     * @ORM\Column(name="corps", type="text")
     */
    private $corps;
    
    /**
     * @ORM\ManyToOne(targetEntity="LFSM\DonateurBundle\Entity\Donateur")
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
     * Set date
     *
     * @param \DateTime $date
     * @return NoteDonateur
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime 
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set titre
     *
     * @param string $titre
     * @return NoteDonateur
     */
    public function setTitre($titre)
    {
        $this->titre = $titre;

        return $this;
    }

    /**
     * Get titre
     *
     * @return string 
     */
    public function getTitre()
    {
        return $this->titre;
    }

    /**
     * Set corps
     *
     * @param string $corps
     * @return NoteDonateur
     */
    public function setCorps($corps)
    {
        $this->corps = $corps;

        return $this;
    }

    /**
     * Get corps
     *
     * @return string 
     */
    public function getCorps()
    {
        return $this->corps;
    }

    /**
     * Set donateur
     *
     * @param \LFSM\DonateurBundle\Entity\Donateur $donateur
     * @return NoteDonateur
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
