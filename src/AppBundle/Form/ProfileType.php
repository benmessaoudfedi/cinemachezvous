<?php
// src/AppBundle/Form/RegistrationType.php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Security\Core\Validator\Constraints\UserPassword;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;



class ProfileType extends AbstractType
{
    /**
     * @var TokenStorage
     */
    protected $tokenStorage;

    /**
     * @param \Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage    $tokenStorage
     */
    public function __construct(TokenStorage $tokenStorage)
    {
        $this->tokenStorage = $tokenStorage;
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $this->buildUserForm($builder, $options);


        $constraintsOptions = array(
            'message' => 'fos_user.current_password.invalid',
        );

        if (!empty($options['validation_groups'])) {
            $constraintsOptions['groups'] = array(reset($options['validation_groups']));
        }

        $builder->add('current_password', PasswordType::class, array(
            'label' => '',
            'translation_domain' => 'FOSUserBundle',
            'mapped' => false,
            'constraints' => array(
                new NotBlank(),
                new UserPassword($constraintsOptions),
            ),
            'attr' => array(
                'autocomplete' => 'current-password',
                'class'=>'form-control',
                'placeholder'=>'form.current_password'
            ),
        ));
    }
    protected function buildUserForm(FormBuilderInterface $builder, array $options)
    {
        $user = $this->tokenStorage->getToken()->getUser();
        $userroles = $user->getRoles();
        $userlastname= $user->getLastname();
        $useradresse= $user->getAddress();
        $userfirstname= $user->getFirstname();
        $userage= $user->getAge();
        $usermobile = $user->getMobile();
        $usernomcine = $user->getNomcinema();
        $userniv = $user->getNivEtud();

        if($userroles[0]=='ROLE_ADMIN'){
            $builder

                ->add('username', null, array('label' => 'form.username', 'translation_domain' => 'FOSUserBundle','attr'=>array(
                    'class'=>'form-control',
                    'placeholder'=>'form.username'
                )))
                ->add('email', EmailType::class, array('label' => '', 'translation_domain' => 'FOSUserBundle','attr'=>array(
                    'class'=>'form-control',
                    'placeholder'=>'form.email'
                )))

            ;
        }
        if($userroles[0]=='ROLE_ORGANISATEUR'){
            $builder

                ->add('username', null, array('label' => '', 'translation_domain' => 'FOSUserBundle','attr'=>array(
                    'class'=>'form-control',
                    'placeholder'=>'form.username'
                )))
                ->add('email', EmailType::class, array('label' => '', 'translation_domain' => 'FOSUserBundle','attr'=>array(
                    'class'=>'form-control',
                    'placeholder'=>'form.email'
                )));
                 if($useradresse == NULL) {
                     $builder
                         ->add('address', TextType::class, array('label' => '', 'translation_domain' => 'FOSUserBundle', 'attr' => array(
                             'class' => 'form-control',
                             'placeholder' => 'Adresse'
                         )));
                 }
                 else{
                     $builder
                         ->add('address', TextType::class, array('label' => '', 'translation_domain' => 'FOSUserBundle', 'attr' => array(
                             'class' => 'form-control',
                             'placeholder' => 'form.address'
                         )));
                 }
                 if($usermobile == NULL) {
                $builder
                    ->add('mobile', TextType::class, array('label' => '', 'translation_domain' => 'FOSUserBundle', 'attr' => array(
                        'class' => 'form-control',
                        'placeholder' => 'Numéro de téléphone'
                    )));
                 }
                 else{
                $builder
                    ->add('mobile', TextType::class, array('label' => '', 'translation_domain' => 'FOSUserBundle', 'attr' => array(
                        'class' => 'form-control',
                        'placeholder' => 'form.mobile'
                    )));
                  }
                  if($usernomcine == NULL) {
                      $builder
                    ->add('nomcinema', TextType::class, array('label' => '', 'translation_domain' => 'FOSUserBundle', 'attr' => array(
                        'class' => 'form-control',
                        'placeholder' => 'Nom du cinéma'
                            )));
                    }
                    else{
                $builder
                    ->add('nomcinema', TextType::class, array('label' => '', 'translation_domain' => 'FOSUserBundle', 'attr' => array(
                        'class' => 'form-control',
                        'placeholder' => 'form.nomcinema'
                    )));
            }
            ;
        }
             if($userroles[0]=='ROLE_USER'){
            $builder

                ->add('username', null, array('label' => 'form.username', 'translation_domain' => 'FOSUserBundle','attr'=>array(
                    'class'=>'form-control',
                    'placeholder'=>'form.username'
                )))
                ->add('email', EmailType::class, array('label' => '', 'translation_domain' => 'FOSUserBundle','attr'=>array(
                    'class'=>'form-control',
                    'placeholder'=>'form.email'
                )));
                if($useradresse == NULL) {
                     $builder
                         ->add('address', TextType::class, array('label' => '', 'translation_domain' => 'FOSUserBundle', 'attr' => array(
                             'class' => 'form-control',
                             'placeholder' => 'Adresse'
                         )));
                 }
                 else{
                     $builder
                         ->add('address', TextType::class, array('label' => '', 'translation_domain' => 'FOSUserBundle', 'attr' => array(
                             'class' => 'form-control',
                             'placeholder' => 'form.address'
                         )));
                }
                if($usermobile == NULL) {
                     $builder
                         ->add('mobile', TextType::class, array('label' => '', 'translation_domain' => 'FOSUserBundle', 'attr' => array(
                             'class' => 'form-control',
                             'placeholder' => 'Numéro de téléphone'
                         )));
                 }
                else{
                     $builder
                         ->add('mobile', TextType::class, array('label' => '', 'translation_domain' => 'FOSUserBundle', 'attr' => array(
                             'class' => 'form-control',
                             'placeholder' => 'form.mobile'
                         )));
                }
                if($userage == NULL) {
                     $builder
                         ->add('age', IntegerType::class, array('label' => '', 'translation_domain' => 'FOSUserBundle', 'attr' => array(
                             'class' => 'form-control',
                             'placeholder' => 'Age',
                             'min'=>0,
                             'max'=>100

                         )));
                 }
                else{
                     $builder
                         ->add('age', IntegerType::class, array('label' => '', 'translation_domain' => 'FOSUserBundle', 'attr' => array(
                             'class' => 'form-control',
                             'placeholder' => 'form.age',
                             'min'=>0,
                             'max'=>100
                         )));
                }
                if($userlastname == NULL) {
                     $builder
                         ->add('lastname', TextType::class, array('label' => '', 'translation_domain' => 'FOSUserBundle', 'attr' => array(
                             'class' => 'form-control',
                             'placeholder' => 'Nom'
                         )));
                 }
                else{
                     $builder
                         ->add('lastname', TextType::class, array('label' => '', 'translation_domain' => 'FOSUserBundle', 'attr' => array(
                             'class' => 'form-control',
                             'placeholder' => 'form.lastname'
                         )));
                 }
                if($userfirstname == NULL) {
                     $builder
                         ->add('firstname', TextType::class, array('label' => '', 'translation_domain' => 'FOSUserBundle', 'attr' => array(
                             'class' => 'form-control',
                             'placeholder' => 'Prénom'
                         )));
                 }
                else{
                     $builder
                         ->add('firstname', TextType::class, array('label' => '', 'translation_domain' => 'FOSUserBundle', 'attr' => array(
                             'class' => 'form-control',
                             'placeholder' => 'form.firstname'
                         )));
                 }
                if($userniv == NULL) {
                     $builder
                         ->add('niv_etud', TextType::class, array('label' => '', 'translation_domain' => 'FOSUserBundle',
                             'attr' => array(
                             'class' => 'form-control',
                             'placeholder' => "Niveau d'étude"
                         )));
                 }
                else{
                     $builder
                         ->add('niv_etud', TextType::class, array('label' => '', 'translation_domain' => 'FOSUserBundle', 'attr' => array(
                             'class' => 'form-control',
                             'placeholder' => 'form.niv_etud'
                         )));
                 }
        }
    }

    public function getParent()
    {
        return 'FOS\UserBundle\Form\Type\ProfileFormType';

        // Or for Symfony < 2.8
        // return 'fos_user_registration';
    }

    public function getBlockPrefix()
    {
        return 'app_user_profile';
    }

    // For Symfony 2.x
    public function getName()
    {
        return $this->getBlockPrefix();
    }
}