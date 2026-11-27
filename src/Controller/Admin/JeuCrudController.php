<?php

namespace App\Controller\Admin;

use App\Entity\Jeu;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class JeuCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Jeu::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('titre'),
            AssociationField::new('categories'),
            TextEditorField::new('description'),
            IntegerField::new('duree_moyenne'),
            IntegerField::new('age_minimum'),
            IntegerField::new('nombre_joueurs')
        ];

    // #[ORM\ManyToOne(inversedBy: 'categories')]
    // #[ORM\JoinColumn(nullable: false)]
    }
}
