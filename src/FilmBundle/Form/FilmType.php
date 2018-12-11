<?php

namespace FilmBundle\Form;

use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Doctrine\ORM\EntityRepository;

class FilmType extends AbstractType
{
    /**
     * @var TokenStorage
     */
    protected $tokenStorage;

    public function __construct(TokenStorage $tokenStorage)
    {
        $this->tokenStorage = $tokenStorage;
    }
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $user = $this->tokenStorage->getToken()->getUser();
        $userid= $user->getId();
        $userroles=$user->getRoles();
        if($userroles[0]=='ROLE_ADMIN'){
        $builder->add('nom',TextType::class,array(
            'label'=>'Titre',

            'attr' => array(
                'class' => 'form-control',
                'placeholder' => 'Titre du film'
            )))
            ->add('resumer',TextareaType::class,array(
                'label'=>'Resumer',
                'attr' => array(
                    'class' => 'form-control',
                    'placeholder' => 'Résumer du film'
                )))
            ->add('nombreSpect',IntegerType::class,array(
                'label'=>'Nombre de spectateur',
                'attr'=>array(
                    'class'=>'form-control',
                    'min'=>0,
                )
            ))
            ->add('duree',TimeType::class,array(
                'label'=>'Durée',
                'attr'=>array(
                    'class'=>'form-control timepicker',

                )
            ))
            ->add('heureDebut',TimeType::class,array(
                'label'=>'Heure début',
                'attr'=>array(
                    'class'=>'form-control timepicker'
                )
            ))
            ->add('prix',TextType::class,array(
                'label'=>'Prix',

                'attr' => array(
                    'class' => 'form-control',
                    'placeholder' => '10 Dinar'
                )))

            ->add('users',EntityType::class,array(
                'class'=>'AppBundle:User',
                'query_builder' => function (EntityRepository $er) {
                    $userroles=array("ROLE_ORGANISATEUR");
                    return $er->createQueryBuilder('u')
                        ->where('u.roles LIKE :roles')
                        ->setParameter('roles', '%"' . $userroles[0] . '"%');
                },
                'attr' => array(
                    'class' => 'form-control',
                    'placeholder' => 'form.niv_etud'
                )

            ));

        }
        if($userroles[0]=='ROLE_ORGANISATEUR'){
            $builder->add('nom',TextType::class,array(
                'label'=>'Titre',

                'attr' => array(
                    'class' => 'form-control',
                    'placeholder' => 'Titre du film'
                )))
                ->add('resumer',TextareaType::class,array(
                    'label'=>'Resumer',
                    'attr' => array(
                        'class' => 'form-control',
                        'placeholder' => 'Résumer du film'
                    )))
                ->add('nombreSpect',IntegerType::class,array(
                    'label'=>'Nombre de spectateur',
                    'attr'=>array(
                        'class'=>'form-control',
                        'min'=>0,
                    )
                ))
                ->add('duree',TimeType::class,array(
                    'label'=>'Durée',
                    'attr'=>array(
                        'class'=>'form-control timepicker',

                    )
                ))
                ->add('heureDebut',TimeType::class,array(
                    'label'=>'Heure début',
                    'attr'=>array(
                        'class'=>'form-control timepicker'
                    )
                ))
                ->add('prix',TextType::class,array(
                    'label'=>'Prix',

                    'attr' => array(
                        'class' => 'form-control',
                        'placeholder' => '10 Dinar'
                    )));
        }

    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'FilmBundle\Entity\Film'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'filmbundle_film';
    }


}
