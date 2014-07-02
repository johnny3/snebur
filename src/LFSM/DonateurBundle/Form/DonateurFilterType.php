<?php

namespace LFSM\DonateurBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Doctrine\ORM\EntityRepository;

class DonateurFilterType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
                ->add('id')
                ->add('civilite', 'entity', array(
                    'class' => 'LFSMAdminBundle:Civilite',
                    'empty_value' => '',
                    'query_builder' => function(EntityRepository $er) {
                        return $er->createQueryBuilder('q')
                                ->orderBy('q.civ_lib', 'ASC');
                    },
                ))
                ->add('rs')
                ->add('nom')
                ->add('prenom')
                ->add('cp')
                ->add('ville')
                ->add('etat', 'entity', array(
                    'class' => 'LFSMAdminBundle:Etat',
                    'empty_value' => '',
                    'query_builder' => function(EntityRepository $er) {
                        return $er->createQueryBuilder('q')
                                ->orderBy('q.etat_lib', 'ASC');
                    },
                ))
                ->add('statut', 'entity', array(
                    'class' => 'LFSMAdminBundle:Statut',
                    'empty_value' => '',
                    'query_builder' => function(EntityRepository $er) {
                        return $er->createQueryBuilder('q')
                                ->orderBy('q.statutlib', 'ASC');
                    },
                ))
                ->add('birthday', 'birthday', array (
                    'years' => range(1920, date('Y')),
                    'empty_value' => '',
                        ))
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
                ->add('nbAnneesFidelite', 'choice', array(
                        'empty_value' => '',
                        'choices' => array(
                                date('Y')                    => date('Y'),
                                (date('Y') - 1)              => date('Y') - 1,
                                (date('Y') - 2)              => date('Y') - 2,
                                (date('Y') - 3)              => date('Y') - 3,
                                (date('Y') - 4)              => date('Y') - 4,
                                (date('Y') - 5) . ' et plus' => date('Y') - 5 . ' et plus',
                        ),
                ))
                ->add('hasEmail', 'choice', array(
                        'empty_value' => '',
                        'choices' => array(
                                '0'     => 'Non renseigné',
                                '1'     => 'Renseigné',
                        ),
                ))
                ->add('modeDePaiement', 'entity', array(
                    'class' => 'LFSMAdminBundle:Mdp',
                    'empty_value' => '',
                    'query_builder' => function(EntityRepository $er) {
                        return $er->createQueryBuilder('mdp')
                                ->orderBy('mdp.mdp_lib', 'ASC');
                    },
                ))
                ->add('hasPhoneNumber', 'choice', array(
                        'empty_value' => '',
                        'choices' => array(
                                '0'     => 'Aucun numéro renseigné',
                                '1'     => 'Au moins un numéro enseigné',
                        ),
                ));
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'LFSM\DonateurBundle\Entity\DonateurFilter'
        ));
    }

    public function getName()
    {
        return 'lfsm_donateurbundle_donateurfiltertype';
    }

}
