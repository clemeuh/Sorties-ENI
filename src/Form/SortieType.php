<?php


namespace App\Form;




use App\Entity\Sortie;


use Symfony\Component\Form\AbstractType;

use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;

use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SortieType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('Nom', TextType::class)

            ->add('dateHeureDebut', DateTimeType::class,[
                'attr'=>['class'=>'form-control js-datepicker'],
                'label'=>'Date et Heure de sortie',
                'required'=>true,
                'widget'=>'single_text'

            ])

            ->add('nbInscriptionMax', null)

            ->add('duree', ChoiceType::class, array(
                'multiple' => true,
                'expanded' => true,
                'choices' => [
                    '1h' => '1H00',
                    '1h30' => '1H30',
                    '2H' => '2H00',
                    '2H30'=>'2H30',
                    '3H00'=>'3H00',
                    '3H30'=>'3H30',
                    '4H00'=>'4H00',
                    '4H30'=>'4H30',
                    '5H00'=>'5H00',
                    '5H30'=>'5H30',
                    '6H00'=>'6H00',
                    '6H30'=>'6H30',

            ]))


            ->add('dateLimiteInscription', DateTimeType::class,[
                'attr'=>['class'=>'form-control js-datepicker'],
                'label'=>'Date de cloture',
                'required'=>true,
                'widget'=>'single_text'
            ])

            ->add('infosSortie', TextareaType::class, ['required' => false])



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
