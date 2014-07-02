<?php

namespace LFSM\AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Doctrine\ORM\EntityRepository;

class ActionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('act_code')
            ->add('theme', 'entity', array(
                    'class' => 'LFSMAdminBundle:Theme',
                    'empty_value' => '',
                    'query_builder' => function(EntityRepository $er) {
                        return $er->createQueryBuilder('q')
                                ->orderBy('q.the_lib', 'ASC');
                    },
                ))
            ->add('act_lib')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'LFSM\AdminBundle\Entity\Action'
        ));
    }

    public function getName()
    {
        return 'lfsm_adminbundle_actiontype';
    }
}
