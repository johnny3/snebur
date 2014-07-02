<?php

namespace LFSM\DonateurBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class DateMontantFilterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('dateDebut')
            ->add('dateFin')
            ->add('montantMin')
            ->add('montantMax')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'LFSM\DonateurBundle\Entity\DateMontantFilter'
        ));
    }

    public function getName()
    {
        return 'lfsm_donateurbundle_datemontantfiltertype';
    }
}
