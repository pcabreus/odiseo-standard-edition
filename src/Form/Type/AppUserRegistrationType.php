<?php

namespace App\Form\Type;

use App\Form\EventListener\AddPasswordSubscriber;
use Sylius\Bundle\UserBundle\Form\Type\UserType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class AppUserRegistrationType extends UserType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        parent::buildForm($builder, $options);

        $builder
            ->remove('username')
            ->remove('enabled')
            ->remove('plainPassword')
            ->add('firstName', TextType::class, [
                'label' => 'Nombre',
                'attr' => [
                    'placeholder' => 'Nombre'
                ],
            ])
            ->add('lastName', TextType::class, [
                'label' => 'Apellido',
                'attr' => [
                    'placeholder' => 'Apellido'
                ]
            ])
            ->add('email', EmailType::class, [
                'label' => 'Email',
                'attr' => array(
                    'placeholder' => 'Email'
                )
            ])
        ;

        $builder->addEventSubscriber(new AddPasswordSubscriber());
    }

    public function getBlockPrefix()
    {
        return 'app_registration';
    }
}
