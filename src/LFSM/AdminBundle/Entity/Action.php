<?php

namespace LFSM\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Action
 *
 * @ORM\Table(name="action")
 * @ORM\Entity(repositoryClass="LFSM\AdminBundle\Repository\ActionRepository")
 */
class Action {

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
     * @ORM\Column(name="act_code", type="integer")
     */
    private $act_code;

//    /**
//     * @var string
//     *
//     * @ORM\Column(name="act_the_code", type="string", length=255)
//     */
//    private $act_the_code;

    /**
     * @ORM\ManyToOne(targetEntity="LFSM\AdminBundle\Entity\Theme")
     * @ORM\JoinColumn(name="act_the_code", referencedColumnName="id", nullable=false)
     */
    private $theme;

    /**
     * @var string
     *
     * @ORM\Column(name="act_lib", type="string", length=255)
     */
    private $act_lib;

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
        return $this->act_code . $this->theme->getCodeLib() . ' / ' . $this->act_lib;
    }

    /**
     * Set act_code
     *
     * @param integer $actCode
     * @return Action
     */
    public function setActCode($actCode)
    {
        $this->act_code = $actCode;

        return $this;
    }

    /**
     * Get act_code
     *
     * @return integer 
     */
    public function getActCode()
    {
        return $this->act_code;
    }

    /**
     * Set act_lib
     *
     * @param string $actLib
     * @return Action
     */
    public function setActLib($actLib)
    {
        $this->act_lib = $actLib;

        return $this;
    }

    /**
     * Get act_lib
     *
     * @return string 
     */
    public function getActLib()
    {
        return $this->act_lib;
    }


    /**
     * Set theme
     *
     * @param \LFSM\AdminBundle\Entity\Theme $theme
     * @return Action
     */
    public function setTheme(\LFSM\AdminBundle\Entity\Theme $theme)
    {
        $this->theme = $theme;
    
        return $this;
    }

    /**
     * Get theme
     *
     * @return \LFSM\AdminBundle\Entity\Theme 
     */
    public function getTheme()
    {
        return $this->theme;
    }
}