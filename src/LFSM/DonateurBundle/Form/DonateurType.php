<?php

namespace LFSM\DonateurBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Doctrine\ORM\EntityRepository;

class DonateurType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
                ->add('statut', 'entity', array(
                    'class' => 'LFSMAdminBundle:Statut',
                    'empty_value' => '',
                    'query_builder' => function(EntityRepository $er) {
                        return $er->createQueryBuilder('q')
                                ->orderBy('q.statutlib', 'ASC');
                    },
                ))
                ->add('etat', 'entity', array(
                    'class' => 'LFSMAdminBundle:Etat',
                    'empty_value' => '',
                    'query_builder' => function(EntityRepository $er) {
                        return $er->createQueryBuilder('q')
                                ->orderBy('q.etat_lib', 'ASC');
                    },
                ))
                ->add('fonction', 'entity', array(
                    'class' => 'LFSMAdminBundle:Fonction',
                    'empty_value' => '',
                    'query_builder' => function(EntityRepository $er) {
                        return $er->createQueryBuilder('q')
                                ->orderBy('q.fct_lib', 'ASC');
                    },
                ))
                ->add('rs')
                ->add('civilite', 'entity', array(
                    'class' => 'LFSMAdminBundle:Civilite',
                    'empty_value' => '',
                    'query_builder' => function(EntityRepository $er) {
                        return $er->createQueryBuilder('q')
                                ->orderBy('q.civ_lib', 'ASC');
                    },
                ))
                ->add('nom')
                ->add('prenom')
                ->add('adresse')
                ->add('adresseComplementaire')
                ->add('lieuDit')
                ->add('bp')
                ->add('cp')
                ->add('ville')
                ->add('birthday', 'birthday')
                ->add('telPtb')
                ->add('telPrm')
                ->add('telSec')
                ->add('fax')
                ->add('email')
                ->add('indice_t')
                ->add('promesse')
                ->add('statutSocial')
                ->add('nombreEnfants', 'choice', array(
                        'empty_value' => '',
                        'choices' => array(
                                '0'     => 'Aucun',
                                '1'     => '1',
                                '2'     => '2',
                                '3'     => '3',
                                'plus'  => 'plus de 3',
                        ),
                ))
        //  ->add('khis')
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
        return 'lfsm_donateurbundle_donateurtype';
    }

}
