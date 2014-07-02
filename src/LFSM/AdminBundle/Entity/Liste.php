<?php

namespace LFSM\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Liste
 *
 * @ORM\Table(name="liste")
 * @ORM\Entity(repositoryClass="LFSM\AdminBundle\Repository\ListeRepository")
 */
class Liste
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
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;
    
     /**
     * @ORM\ManyToMany(targetEntity="LFSM\AdminBundle\Entity\Etat", cascade={"persist"})
     */
    private $etat;


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
     * Set name
     *
     * @param string $name
     * @return Liste
     */
    public function setName($name)
    {
        $this->name = $name;
    
        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->etat = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Add etat
     *
     * @param \LFSM\AdminBundle\Entity\Etat $etat
     * @return Liste
     */
    public function addEtat(\LFSM\AdminBundle\Entity\Etat $etat)
    {
        $this->etat[] = $etat;
    
        return $this;
    }

    /**
     * Remove etat
     *
     * @param \LFSM\AdminBundle\Entity\Etat $etat
     */
    public function removeEtat(\LFSM\AdminBundle\Entity\Etat $etat)
    {
        $this->etat->removeElement($etat);
    }

    /**
     * Get etat
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getEtat()
    {
        return $this->etat;
    }
}