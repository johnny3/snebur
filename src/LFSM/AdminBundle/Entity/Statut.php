<?php

namespace LFSM\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Statut
 *
 * @ORM\Table(name="statut")
 * @ORM\Entity(repositoryClass="LFSM\AdminBundle\Repository\StatutRepository")
 */
class Statut
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
     * @ORM\Column(name="statut_lib", type="string", length=255)
     */
    private $statutlib;


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
        return $this->statutlib;
    }

    /**
     * Set statutlib
     *
     * @param string $statutlib
     * @return Statut
     */
    public function setStatutlib($statutlib)
    {
        $this->statutlib = $statutlib;
    
        return $this;
    }

    /**
     * Get statutlib
     *
     * @return string 
     */
    public function getStatutlib()
    {
        return $this->statutlib;
    }
}