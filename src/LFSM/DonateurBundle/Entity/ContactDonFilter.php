<?php

namespace LFSM\DonateurBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ContactDonFilter
 *
 * @ORM\Table(name="contact_don_filter")
 * @ORM\Entity(repositoryClass="LFSM\DonateurBundle\Repository\ContactDonFilterRepository")
 */
class ContactDonFilter
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
     * @var integer
     *
     * @ORM\Column(name="age_min", type="integer")
     */
    private $ageMin;

    /**
     * @var integer
     *
     * @ORM\Column(name="age_max", type="integer")
     */
    private $ageMax;

    /**
     * @var integer
     *
     * @ORM\Column(name="annee_debut", type="integer")
     */
    private $anneeDebut;

    /**
     * @var integer
     *
     * @ORM\Column(name="annee_fin", type="integer")
     */
    private $anneeFin;


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
     * Set ageMin
     *
     * @param integer $ageMin
     * @return ContactDonFilter
     */
    public function setAgeMin($ageMin)
    {
        $this->ageMin = $ageMin;
    
        return $this;
    }

    /**
     * Get ageMin
     *
     * @return integer 
     */
    public function getAgeMin()
    {
        return $this->ageMin;
    }

    /**
     * Set ageMax
     *
     * @param integer $ageMax
     * @return ContactDonFilter
     */
    public function setAgeMax($ageMax)
    {
        $this->ageMax = $ageMax;
    
        return $this;
    }

    /**
     * Get ageMax
     *
     * @return integer 
     */
    public function getAgeMax()
    {
        return $this->ageMax;
    }

    /**
     * Set anneeDebut
     *
     * @param integer $anneeDebut
     * @return ContactDonFilter
     */
    public function setAnneeDebut($anneeDebut)
    {
        $this->anneeDebut = $anneeDebut;
    
        return $this;
    }

    /**
     * Get anneeDebut
     *
     * @return integer 
     */
    public function getAnneeDebut()
    {
        return $this->anneeDebut;
    }

    /**
     * Set anneeFin
     *
     * @param integer $anneeFin
     * @return ContactDonFilter
     */
    public function setAnneeFin($anneeFin)
    {
        $this->anneeFin = $anneeFin;
    
        return $this;
    }

    /**
     * Get anneeFin
     *
     * @return integer 
     */
    public function getAnneeFin()
    {
        return $this->anneeFin;
    }
}
