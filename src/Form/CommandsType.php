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
                'label' => 'Jours de votre visite'
            ])
            ->add('nbr_tickets', IntegerType::class, [
                'label'=>'Nombre de tickets'
            ])
            ->add('duration', ChoiceType::class, [
                'choices' => [
                    'Journée' => true,
                    'Demi-journée' => false
                ],
                'attr' => ['class' => 'duration'],
                'placeholder' => 'Choix du type de billet',
                'label' => 'Durée de la visite'
            ])
            ->add('mail', EmailType::class, [
                'label' => 'Adresse mail'
            ])
            ->add('valider', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Commands::class,
        ]);
    }
}
