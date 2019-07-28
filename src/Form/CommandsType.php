<?php

namespace App\Form;

use App\Entity\Commands;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CommandsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('date_visit', DateType::class, [
                'widget' => 'single_text',
                'html5' => false,
                'attr' => ['class' => 'js-datepicker'],
                'label' => 'Day of your visit'
            ])
            ->add('nbr_tickets', IntegerType::class, [
                'label'=>'Number of tickets'
            ])
            ->add('duration', ChoiceType::class, [
                'choices' => [
                    'Day' => true,
                    'Half day' => false
                ],
                'attr' => ['class' => 'duration'],
                'placeholder' => 'Choice of ticket type',
                'label' => 'Duration of the visit'
            ])
            ->add('mail', EmailType::class, [
                'label' => 'Mail address'
            ])
            ->add('valider', SubmitType::class, [
                'label' => 'Validate'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Commands::class,
        ]);
    }
}
