<?php

namespace App\Form;

use App\Entity\Categorie;
use App\Entity\Jeu;
use DateTime;
use Dom\Entity;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FormulaireJeuType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('titre')
            ->add('age_minimum', DateTime::class, [
            ])
            ->add('Jeu', EntityType::class, [
                'class' => Jeu::class,
                'placeholder' => 'Choisir un type',
                'attr' => [
                    'class' => 'input-test'
                ]    
            ])
            ->add('categories', EntityType::class, [
                'class' => Categorie::class,
                'choice_label'=>'nom',
                'multiple' => true,
                'expanded' => true,
                'required' => false
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
