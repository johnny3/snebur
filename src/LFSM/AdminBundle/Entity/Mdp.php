<?php

namespace LFSM\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Mdp
 *
 * @ORM\Table(name="mdp")
 * @ORM\Entity(repositoryClass="LFSM\AdminBundle\Repository\MdpRepository")
 */
class Mdp
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
     * @ORM\Column(name="mdp_lib", type="string", length=255)
     */
    private $mdp_lib;


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
        return $this->mdp_lib;
    }

    /**
     * Set mdp_lib
     *
     * @param string $mdpLib
     * @return Mdp
     */
    public function setMdpLib($mdpLib)
    {
        $this->mdp_lib = $mdpLib;
    
        return $this;
    }

    /**
     * Get mdp_lib
     *
     * @return string 
     */
    public function getMdpLib()
    {
        return $this->mdp_lib;
    }
}