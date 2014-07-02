<?php

namespace LFSM\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Civilite
 *
 * @ORM\Table(name="civilite")
 * @ORM\Entity(repositoryClass="LFSM\AdminBundle\Repository\CiviliteRepository")
 */
class Civilite
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
     * @ORM\Column(name="civ_lib_court", type="string", length=255)
     */
    private $civ_lib_court;

    /**
     * @var string
     *
     * @ORM\Column(name="civ_lib", type="string", length=255)
     */
    private $civ_lib;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }
    
    public function __toString()
    {
        return $this->civ_lib_court;
    }

    /**
     * Set civ_lib_court
     *
     * @param string $civLibCourt
     * @return Civilite
     */
    public function setCivLibCourt($civLibCourt)
    {
        $this->civ_lib_court = $civLibCourt;
    
        return $this;
    }

    /**
     * Get civ_lib_court
     *
     * @return string 
     */
    public function getCivLibCourt()
    {
        return $this->civ_lib_court;
    }

    /**
     * Set civ_lib
     *
     * @param string $civLib
     * @return Civilite
     */
    public function setCivLib($civLib)
    {
        $this->civ_lib = $civLib;
    
        return $this;
    }

    /**
     * Get civ_lib
     *
     * @return string 
     */
    public function getCivLib()
    {
        return $this->civ_lib;
    }
}