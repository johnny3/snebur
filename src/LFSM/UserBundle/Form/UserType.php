<?php

namespace LFSM\UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Security\Core\Validator\Constraint\UserPassword as OldUserPassword;
use Symfony\Component\Security\Core\Validator\Constraints\UserPassword;
use Symfony\Component\DependencyInjection\ContainerInterface as Container;

class UserType extends AbstractType
{
    private $roles;
    private $currentRole;
    
    public function __construct($rolesTab, $currentRole)
    {
        foreach ($rolesTab as $key=>$roleTab){
            $roles[$key] = $key;
        }
        $this->roles = $roles;
        $this->currentRole = $currentRole;
    }
    
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        if (class_exists('Symfony\Component\Security\Core\Validator\Constraints\UserPassword')) {
            $constraint = new UserPassword();
        } else {
            // Symfony 2.1 support with the old constraint class
            $constraint = new OldUserPassword();
        }
        
        $builder
            ->add('username', null, array('label' => 'form.username', 'translation_domain' => 'FOSUserBundle'))
            ->add('email', 'email', array('label' => 'form.email', 'translation_domain' => 'FOSUserBundle'))
            ->add('current_password', 'password', array(
            'label' => 'form.current_password',
            'translation_domain' => 'FOSUserBundle',
            'mapped' => false,
            'constraints' => $constraint,
        ))
            ->add('roles', 'choice', array(
                                'data' => $this->currentRole,
                                'choices'   => $this->roles,
                                'mapped' => false,
                                'multiple'  => false,
            ));
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'LFSM\UserBundle\Entity\User'
        ));
    }

    public function getName()
    {
        return 'lfsm_donateurbundle_usertype';
    }
}
