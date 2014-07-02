<?php

namespace LFSM\AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ListeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('etat', 'entity', array(
                'class' => 'LFSMAdminBundle:Etat',
                'expanded' => true,
                'multiple' => true,
            ));
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'LFSM\AdminBundle\Entity\Liste'
        ));
    }

    public function getName()
    {
        return 'lfsm_adminbundle_listetype';
    }
}
