<?php

namespace App\Form;

use App\Entity\Participant;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom', TextType::class, [
                'label'=>'Nom'
            ])
            ->add('prenom')
            ->add('mail')
            ->add('telephone', null, [
                'required' => false
                ])
            ->add('Password', RepeatedType::class, [
                'type' => PasswordType::class,
                'required' => true,
                'constraints' => [
                    new NotBlank(),
                    new Length(array('min' => 6)),
                ],
                'first_options'  => ['label' => 'Mot de passe'],
                'second_options' => ['label' => 'Confirmation Mot de passe'],
            ])
            #->add('passwordVerif', PasswordType::class,[
            #    'attr'=>['placeholder'=>'Resaisir password'],
            #    'label'=>'Ressaisir mot de passe'
            #   ])
            ->add('actif')
            ->add('administrateur')

        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Participant::class,
        ]);
    }
}
