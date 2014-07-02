<?php

namespace LFSM\DonateurBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ContactDonFilterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('ageMin')
            ->add('ageMax')
            ->add('anneeDebut')
            ->add('anneeFin')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'LFSM\DonateurBundle\Entity\ContactDonFilter'
        ));
    }

    public function getName()
    {
        return 'lfsm_donateurbundle_contactdonfiltertype';
    }
}
