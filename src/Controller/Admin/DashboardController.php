<?php

namespace App\Controller;

use App\Controller\Admin\CategorieCrudController;
use App\Controller\Admin\JeuCrudController;
use App\Controller\Admin\ReservationCrudController;
use App\Controller\Admin\SoireeJeuCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class DashboardController extends AbstractController
{
    #[Route('/dashboard', name: 'app_dashboard')]
    public function __construct(private AdminUrlGenerator $adminUrlGenerator)
    {
        $this->adminUrlGenerator = $adminUrlGenerator;
    }
    public function index(): Response
    {
        return $this->redirect(
            $this->adminUrlGenerator
                ->setController(JeuCrudController::class)
                ->setAction(Action::INDEX)
                ->generateUrl()
        );
    }
    
    public function configureDashboard(): Dashboard{
        return Dashboard::new()
            ->setTitle('Gamehub');
    }

    public function configureMenuItems(): iterable 
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');

        yield MenuItem::section('Catalogue');

        // Gestion de soirées
        yield MenuItem::linkTo(SoireeJeuCrudController::class, 'Soirée jeux');
        yield MenuItem::linkTo(ReservationCrudController::class, 'Réservations');

        // Gestion de jeux
        yield MenuItem::linkTo(JeuCrudController::class, 'Jeux');
        yield MenuItem::linkTo(CategorieCrudController::class, 'Catégories');
        
    }
}
