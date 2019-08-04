<?php

namespace App\Form;

use App\Entity\Tickets;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TicketsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('first_name', TextType::class, [
            'label'=>'First name'
        ])
            ->add('last_name', TextType::class, [
                'label'=>'Last name'
            ])
            ->add('country', CountryType::class, [
                'preferred_choices' => ['FR']
            ])
            ->add('birth_date', BirthdayType::class, [
                'widget' => 'single_text',
                'html5' => false,
                'attr' => ['class' => 'js-datepicker'],
                'label' => 'Birthday date',
                'format' => 'dd/mm/yyyy',
            ])
            ->add('discount', CheckboxType::class, [
            'required' => false,
            'label' => 'Reduced price',
                'attr' => ['class' => 'discount']
        ])
        ;
    }


    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Tickets::class,
        ]);
    }
}