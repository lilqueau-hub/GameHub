<?php

namespace App\Controller;

use App\Entity\SoireeJeu;
use App\Entity\Utilisateur;
use App\Service\ReservationService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

final class ReservationController extends AbstractController
{
    #[IsGranted('ROLE_USER')]
    #[Route('/soireejeu/{id}/reserver', name: 'app_reservation', methods:['POST'])]
    public function reserver(Request $request, SoireeJeu $soireejeu, ReservationService $reservationService): Response
    {
        // verifier token
        if (!$this->isCsrfTokenValid(
            'reserver_' . $soireejeu->getId(),
            $request->request->get('_token')
        )) {
            $this->addFlash('error', 'Jeton de sécurité invalide');
            return $this->redirectToRoute('app_soireejeu');
        }

        // récupérer utilisateur connecté
        $utilisateur = $this->getUser();
        if (!$utilisateur instanceof Utilisateur) {
            throw $this->$this->createAccessDeniedException();
        }

        try {
            $reservation = $reservationService->reserverSoiree(
                $utilisateur,
                $soireejeu
            );

            $this->addFlash('success', sprintf(
                'Réservation confirmée (soiree %s) !',
                $reservation->getDateReservation()->modify('+7 days')->format('d/m/Y')
            ));
        } catch(\RuntimeException $e) {
            $this->addFlash('error', $e->getMessage());
        }
        return $this->redirectToRoute('app_soireejeu');
    }
}
