<?php
// src/AppBundle/Form/RegistrationType.php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class RegistrationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $roles =array('ROLE_ORGANISATEUR');

        $builder
            ->add('email', EmailType::class, array(
                'label' => '',
                'translation_domain' => 'FOSUserBundle',
                'attr' =>array(
                    'placeholder'=>'form.email',
                     'class' => 'form-control'
                )))
            ->add('username', null, array(
                'label' => '',
                'translation_domain' => 'FOSUserBundle',
                'attr' =>array(
                    'placeholder'=>'form.username',
                    'class' => 'form-control'
                )))
            ->add('plainPassword', RepeatedType::class, array(
                'type' => PasswordType::class,
                'options' => array(
                    'translation_domain' => 'FOSUserBundle',
                    'attr' => array(
                        'autocomplete' => 'new-password',

                    ),
                ),

                'first_options' => array(
                    'attr' => array(
                        'placeholder' => 'form.password',
                        'class' => 'form-control'
                    )
                ),
                'second_options' => array(
                    'attr' => array(
                        'placeholder' => 'form.password_confirmation',
                        'class' => 'form-control'
                    )
                ),
                'invalid_message' => 'fos_user.password.mismatch',
            ))
            ->add('roles', ChoiceType::class, array(
                'choices' => array('Vous êtes un organisateur de cinema ?' => $roles[0]),
                'multiple' => true,
                'expanded'=>true,

            ));


        ;
    }


    public function getParent()
    {
        return 'FOS\UserBundle\Form\Type\RegistrationFormType';

    }

    public function getBlockPrefix()
    {
        return 'app_user_registration';
    }

    // For Symfony 2.x
    public function getName()
    {
        return $this->getBlockPrefix();
    }
}