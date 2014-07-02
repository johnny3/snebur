<?php

namespace LFSM\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Fonction
 *
 * @ORM\Table(name="fonction")
 * @ORM\Entity(repositoryClass="LFSM\AdminBundle\Repository\FonctionRepository")
 */
class Fonction
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
     * @ORM\Column(name="fct_lib", type="string", length=255)
     */
    private $fct_lib;


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
        return $this->fct_lib;
    }

    /**
     * Set fct_lib
     *
     * @param string $fctLib
     * @return Fonction
     */
    public function setFctLib($fctLib)
    {
        $this->fct_lib = $fctLib;
    
        return $this;
    }

    /**
     * Get fct_lib
     *
     * @return string 
     */
    public function getFctLib()
    {
        return $this->fct_lib;
    }
}