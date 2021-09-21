<?php

namespace App\Form;

use App\Entity\Reservation;
use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ReservationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            // ->add('user',  CollectionType::class, [
            //     'entry_type' => User::class,
            //     'entry_options' => array('label' => false)
            //     ])
            ->add('date', DateTimeType::class, [
                'date_widget' => 'single_text'
            ])
            ->add('nb_joueurs')
            
            ->add('prix') // créer un algo pour dynamiser le prix en fonction du jour: jour normal ou week-end/férié
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Reservation::class,
        ]);
    }
}
