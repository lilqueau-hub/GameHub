<?php
namespace App\Service;

use App\Entity\SoireeJeu;
use App\Entity\Utilisateur;
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

    public function reserverJeu(Utilisateur $utilisateur, SoireeJeu $soireejeu): Reservation
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

        if (!$soireeDisponible){
            throw new \RuntimeException('Aucun exemplaire disponible.');
        }

        $maintenant = new DateTimeImmutable();

        $reservation = new Reservation();
        $reservation->setUtilisateur($utilisateur);
        $reservation->setSoireeJeu($soireeDisponible);
        $reservation->setDateReservation($maintenant);
        $reservation->setStatutReservation(StatutReservation::RESERVE);

        $reservationDisponible->setDisponibilite(false);
        $this->em->persist($reservation);
        $this->em->flush();

        return $reservation;
    }
}