<?php

namespace LFSM\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * StatutSocial
 *
 * @ORM\Table(name="statut_social")
 * @ORM\Entity(repositoryClass="LFSM\AdminBundle\Repository\StatutSocialRepository")
 */
class StatutSocial
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
     * @ORM\Column(name="statut_social_libelle", type="string", length=255)
     */
    private $statutSocialLibelle;


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
        return $this->statutSocialLibelle;
    }

    /**
     * Set statutSocialLibelle
     *
     * @param string $statutSocialLibelle
     * @return StatutSocial
     */
    public function setStatutSocialLibelle($statutSocialLibelle)
    {
        $this->statutSocialLibelle = $statutSocialLibelle;

        return $this;
    }

    /**
     * Get statutSocialLibelle
     *
     * @return string 
     */
    public function getStatutSocialLibelle()
    {
        return $this->statutSocialLibelle;
    }
}
