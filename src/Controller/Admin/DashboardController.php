<?php

namespace App\Controller\Admin;

use App\Controller\Admin\JeuCrudController;
use App\Controller\Admin\ReservationCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Attribute\AdminDashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Override;
use Symfony\Component\HttpFoundation\Response;



#[AdminDashboard(routePath: '/admin', routeName:'admin')]
class DashboardController extends AbstractDashboardController
{
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

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Game-Hub');
    }

    #[Override]
    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');

        // Gestion des jeux
        yield MenuItem::section('Jeux');

        yield MenuItem::linkTo(JeuCrudController::class, 'Jeux', 'fas fa-book');
        yield MenuItem::linkTo(CategorieCrudController::class, 'Catégories');

        // Gestion de soirées
        yield MenuItem::section('Soirées');

        yield MenuItem::linkTo(SoireeJeuCrudController::class, 'Soirées', 'fas fa-book');
        yield MenuItem::linkTo(ReservationCrudController::class, 'Réservations');
        }
    // #[Route('/dashboard', name: 'app_dashboard')]
    // public function __construct(private AdminUrlGenerator $adminUrlGenerator)
    // {
    //     $this->adminUrlGenerator = $adminUrlGenerator;
    // }
    // public function index(): Response
    // {
    //     return $this->redirect(
    //         $this->adminUrlGenerator
    //             ->setController(JeuCrudController::class)
    //             ->setAction(Action::INDEX)
    //             ->generateUrl()
    //     );
    // }
    
    // public function configureDashboard(): Dashboard{
    //     return Dashboard::new()
    //         ->setTitle('Gamehub');
    // }

    // public function configureMenuItems(): iterable 
    // {
    //     yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');

    //     yield MenuItem::section('Catalogue');

    //     // Gestion de soirées
    //     yield MenuItem::linkTo(SoireeJeuCrudController::class, 'Soirée jeux');
    //     yield MenuItem::linkTo(ReservationCrudController::class, 'Réservations');

    //     // Gestion de jeux
    //     yield MenuItem::linkTo(JeuCrudController::class, 'Jeux');
    //     yield MenuItem::linkTo(CategorieCrudController::class, 'Catégories');
        
    // }
}
