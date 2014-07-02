<?php

namespace LFSM\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Theme
 *
 * @ORM\Table(name="theme")
 * @ORM\Entity(repositoryClass="LFSM\AdminBundle\Repository\ThemeRepository")
 */
class Theme
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
     * @ORM\Column(name="code_lib", type="string", length=255)
     */
    private $code_lib;

    /**
     * @var string
     *
     * @ORM\Column(name="the_lib", type="string", length=255)
     */
    private $the_lib;

    
    public function __toString()
    {
        return $this->code_lib . ' / ' . $this->the_lib;
    }
    
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
     * Set the_lib
     *
     * @param string $theLib
     * @return Theme
     */
    public function setTheLib($theLib)
    {
        $this->the_lib = $theLib;
    
        return $this;
    }

    /**
     * Get the_lib
     *
     * @return string 
     */
    public function getTheLib()
    {
        return $this->the_lib;
    }

    /**
     * Set code_lib
     *
     * @param string $codeLib
     * @return Theme
     */
    public function setCodeLib($codeLib)
    {
        $this->code_lib = $codeLib;
    
        return $this;
    }

    /**
     * Get code_lib
     *
     * @return string 
     */
    public function getCodeLib()
    {
        return $this->code_lib;
    }
}