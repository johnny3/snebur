<?php

namespace LFSM\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * RefProvenanceFichier
 *
 * @ORM\Table(name="ref_provenance_fichier")
 * @ORM\Entity(repositoryClass="LFSM\AdminBundle\Repository\RefProvenanceFichierRepository")
 */
class RefProvenanceFichier
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
     * @ORM\Column(name="prov_lib", type="string", length=255)
     */
    private $prov_lib;


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
        return $this->prov_lib;
    }
    
    /**
     * Set prov_lib
     *
     * @param string $provLib
     * @return RefProvenanceFichier
     */
    public function setProvLib($provLib)
    {
        $this->prov_lib = $provLib;
    
        return $this;
    }

    /**
     * Get prov_lib
     *
     * @return string 
     */
    public function getProvLib()
    {
        return $this->prov_lib;
    }
}