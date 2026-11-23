<?php

namespace App\Form;

use App\Entity\SoireeJeu;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FormulaireSoireeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('titre')
            ->add('Soiree_jeu', EntityType::class, [
                'class' => SoireeJeu::class,
                'placeholder' => '',
                'attr' => [
                    'class' => 'input-test'
                ]
            ])


        //     $builder
        //     ->add('titre')
        //     ->add('age_minimum', DateTime::class, [
        //     ])
        //     ->add('Jeu', EntityType::class, [
        //         'class' => Jeu::class,
        //         'placeholder' => 'Choisir un type',
        //         'attr' => [
        //             'class' => 'input-test'
        //         ]    
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
