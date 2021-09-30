<?php

namespace App\Form;

use App\Entity\Reservation;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\GreaterThan;

class ReservationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('date', DateTimeType::class, [
                'date_widget' => 'single_text',
                'hours' => range(9, 19),
                'minutes' => [00],
                'attr' => [],
                'constraints' => [
                    new GreaterThan(date("Y/m/d H:i"), null, 'Veuillez choisir une date valide')
                ]

            ])
            ->add('nb_joueurs', IntegerType::class, [
                'attr' => [
                    'min' => 1,
                    'max' => 13,
                    'value' => 1
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Reservation::class,
        ]);
    }
}
