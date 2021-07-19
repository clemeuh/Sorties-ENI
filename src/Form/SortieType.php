<?php


namespace App\Form;




use App\Entity\Sortie;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;

use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SortieType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('Nom', TextType::class)

            ->add('dateHeureDebut', DateTimeType::class,[
                'attr'=>['class'=>'form-control'],
                'label'=>'Date et Heure de sortie',
                'required'=>true,
                'widget'=>'single_text',
                'html5'=>false,

            ])


            ->add('nbInscriptionMax', NumberType::class )

            ->add('duree', ChoiceType::class, [
                'attr' => ['class'=>'data-list'],
                'label'=>'Durée de la sortie',])

            ->add('infosSortie', TextareaType::class, ['required' => false])

            ->add('save', SubmitType::class,[
                'label' =>'Enregistrer',
                'attr' => ['class' => 'btn btn-success w-100']
            ])
            ->add('publish', SubmitType::class,[
                'label' =>'Publier',
                'attr' => ['class' => 'btn btn-primary w-100']
            ])
            ->add('cancel', SubmitType::class,[
                'label' =>'Annuler',
                'attr' => ['class' => 'btn btn-danger w-100']

            ])


        ;

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Sortie::class,
        ]);
    }

}

