<?php

namespace LFSM\AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class CiviliteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('civ_lib_court')
            ->add('civ_lib')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'LFSM\AdminBundle\Entity\Civilite'
        ));
    }

    public function getName()
    {
        return 'lfsm_adminbundle_civilitetype';
    }
}
