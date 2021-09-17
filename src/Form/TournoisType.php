<?php

namespace App\Form;

use App\Entity\Tournois;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TournoisType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titre')
            ->add('date_debut')
            ->add('description')
            ->add('max_player')
            ->add('user')
            ->add('prix')
            ->add('jeu')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Tournois::class,
        ]);
    }
}
