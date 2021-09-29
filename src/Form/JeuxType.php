<?php

namespace App\Form;

use App\Entity\Jeux;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class JeuxType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titre')
            ->add('editeur')
            ->add('date', DateType::class,[
                "widget" => "single_text"
            ])
            ->add('type')
            ->add('description')
            ->add('img_cover', FileType::class)
            ->add('img_gameplay', FileType::class, array(
                'multiple' => true,
                'attr' => array(
                    'multiple' => 'multiple'
                )
            ))
            ->add('min_joueur')
            ->add('max_joueur')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Jeux::class,
        ]);
    }
}
