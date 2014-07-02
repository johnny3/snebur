<?php

namespace LFSM\AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class MappingCSVType extends AbstractType 
{
    protected $headers;

    public function __construct($headers)
    {
        $this->headers = $headers;
    }
    
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
                ->add('civilite', 'choice', array(
                        'empty_value' => '',
                        'choices' => $this->headers,
                ))
                ->add('nom', 'choice', array(
                        'empty_value' => '',
                        'choices' => $this->headers,
                ))
                ->add('prenom', 'choice', array(
                        'empty_value' => '',
                        'choices' => $this->headers,
                ))
                ->add('adresse', 'choice', array(
                        'empty_value' => '',
                        'choices' => $this->headers,
                ))
                ->add('adresseComplementaire', 'choice', array(
                        'empty_value' => '',
                        'choices' => $this->headers,
                ))
                ->add('lieuDit', 'choice', array(
                        'empty_value' => '',
                        'choices' => $this->headers,
                ))
                ->add('bp', 'choice', array(
                        'empty_value' => '',
                        'choices' => $this->headers,
                ))
                ->add('cp', 'choice', array(
                        'empty_value' => '',
                        'choices' => $this->headers,
                ))
                ->add('ville', 'choice', array(
                        'empty_value' => '',
                        'choices' => $this->headers,
                ))
                ->add('telPrm', 'choice', array(
                        'empty_value' => '',
                        'choices' => $this->headers,
                ))
                ->add('telSec', 'choice', array(
                        'empty_value' => '',
                        'choices' => $this->headers,
                ))
                ->add('telPtb', 'choice', array(
                        'empty_value' => '',
                        'choices' => $this->headers,
                ))
                ->add('birthday', 'choice', array(
                        'empty_value' => '',
                        'choices' => $this->headers,
                ))
                ->add('email', 'choice', array(
                        'empty_value' => '',
                        'choices' => $this->headers,
                ))
            ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'LFSM\DonateurBundle\Entity\Donateur'
        ));
    }

    public function getName()
    {
        return 'lfsm_adminbundle_donateurtype_upload';
    }

}
