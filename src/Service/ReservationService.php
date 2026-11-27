<?php
namespace App\Service;

use App\Entity\Reservation;
use App\Entity\SoireeJeu;
use App\Entity\Utilisateur;
use App\Enum\StatutReservation;
use App\Repository\ReservationRepository;
use App\Repository\SoireeJeuRepository;
use DateTimeImmutable;
use Doctrine\ORM\EntityManagerInterface;

class ReservationService
{
    public function __construct(
        private ReservationRepository $reservationRepository,
        private EntityManagerInterface $em,
        private SoireeJeuRepository $soireejeuRepository
    ){

    }

    public function reserverSoiree(Utilisateur $utilisateur, SoireeJeu $soireejeu): Reservation
    {
        $reservationExistant = $this->reservationRepository->rechercheParUtilisateurEtSoiree(
            $utilisateur,
            $soireejeu
        );

        if ($reservationExistant) {
            throw new \RuntimeException('Vous avez déjà réservé cette soirée');
        }

        $reservationDisponible = $this->reservationRepository->findOneBy([
            'soiree' => $soireejeu,
            'disponibilite' => true
        ]);

        if (!$reservationDisponible){
            throw new \RuntimeException('Aucune place disponible.');
        }

        $maintenant = new DateTimeImmutable();

        $reservation = new Reservation();
        $reservation->setUtilisateur($utilisateur);
        $reservation->setSoireeJeu($soireejeu);
        $reservation->setDateReservation($maintenant);
        $reservation->setStatutReservation(StatutReservation::RESERVE);

        $reservationDisponible->soireeDisponibilite(false);
        $this->em->persist($reservation);
        $this->em->flush();

        return $reservation;
    }
}