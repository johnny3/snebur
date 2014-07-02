<?php

namespace LFSM\DonateurBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Doctrine\ORM\EntityRepository;

class DonType extends AbstractType
{   
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('dateDon')
            ->add('montant')
            ->add('dateRemiseDon')
            ->add('numCheque')
            ->add('banque')
            ->add('mdp')
            ->add('action', 'entity', array(
                    'class' => 'LFSMAdminBundle:Action',
                    'empty_value' => '',
                    'query_builder' => function(EntityRepository $er) {
                        return $er->myFindAllQuerybuilder();
                    },
                    'empty_value' => '...',
                ))
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'LFSM\DonateurBundle\Entity\Don'
        ));
    }

    public function getName()
    {
        return 'lfsm_donateurbundle_dontype';
    }
}
