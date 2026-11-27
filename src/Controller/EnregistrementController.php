<?php

namespace App\Controller;

use App\Service\InscriptionService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class EnregistrementController extends AbstractController
{
    // #[Route('/enregistrement', name: 'app_enregistrement')]
    // public function index(): Response
    // {
    //     return $this->render('enregistrement/index.html.twig', [
    //         'controller_name' => 'EnregistrementController',
    //     ]);
    // }
    #[Route('/enregistrement', name: 'app_enregistrement')]
    public function enregistrement(Request $request, InscriptionService $inscriptionService): Response
    {
        // Vérification de méthode POST
        if ($request->isMethod('POST')) {
            $email = trim($request->request->get('email'));
            $mdp = trim($request->request->get('mdp'));
            $nom = trim($request->request->get('nom'));
            $prenom = trim($request->request->get('prenom'));

            // vérifier token
            if (!$this->isCsrfTokenValid(
                'register',
                $request->request->get('_csrf_token')
            )) {
                throw $this->createAccessDeniedException('Token CSRF invalide.');
            }

            // Vérifier champs
            if ($email === '' || $mdp === '' || $nom === '' || $prenom === '') {
                $this->addFlash('error', 'Tous les champs sont obligatoires.');
                return $this->redirectToRoute('app_enregistrement');
            }

            // Appeler le service pour effecturer l'inscription
            $inscriptionReussie =
            $inscriptionService->inscrireUtilisateur(
                $nom,
                $prenom,
                $email,
                $mdp
            );

            $this->addFlash('success', 'Votre compte a été créé. Un e-mail de confirmation vous a été envoyé. Consultez votre boîte mail.');

            return $this->redirectToRoute('app_connexion');
        }

        return $this->render('enregistrement/enregistrement.html.twig');
    }
}
