<?php

namespace AppBundle\Form;

use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\NotBlankValidator;

class UserType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username', null, [
                'label' => 'Pseudo'
            ])
            ->add('city', null, [
                'label' => 'Ville'
            ])
            ->add('zipcode', null, [
                'label' => 'Code postal'
            ])
            ->add('email', RepeatedType::class, [
                'type' => EmailType::class,
                'first_options' => ['label' => 'Email'],
                'second_options' => ['label' => 'Confirmer l\'email'],
                'invalid_message' =>'L\'email saisi ne correspond pas',
            ])
            ->add('password', RepeatedType::class, [
                'type' => PasswordType::class,
                'first_options' => ['label' => 'Mot de passe'],
                'second_options' => ['label' => 'Confirmer le mot de passe'],
                'invalid_message' =>'Les mots de passe ne correspondent pas',
            ])
            ->add('agreeTerms', CheckboxType::class, array('mapped' => false,
                'label' => ' J\' accepte les conditions générales d\'utilisation',
                'constraints' => array(new NotBlank(array('message' => 'Veuillez accepter les conditions générales d\'utilisation'))
                )));
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\User'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_user';
    }


}
