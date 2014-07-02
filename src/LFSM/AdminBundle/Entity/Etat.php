<?php

namespace LFSM\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Etat
 *
 * @ORM\Table(name="etat")
 * @ORM\Entity(repositoryClass="LFSM\AdminBundle\Repository\EtatRepository")
 */
class Etat
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
     * @ORM\Column(name="etat_lib", type="string", length=255)
     */
    private $etat_lib;


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
        return $this->etat_lib;
    }

    /**
     * Set etat_lib
     *
     * @param string $etatLib
     * @return Etat
     */
    public function setEtatLib($etatLib)
    {
        $this->etat_lib = $etatLib;
    
        return $this;
    }

    /**
     * Get etat_lib
     *
     * @return string 
     */
    public function getEtatLib()
    {
        return $this->etat_lib;
    }
}