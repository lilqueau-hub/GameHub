<?php

namespace App\Entity;

use App\Repository\ReservationRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ReservationRepository::class)]
class Reservation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE, nullable: true)]
    private ?\DateTimeImmutable $dateReservation = null;

    #[ORM\ManyToOne(inversedBy: 'reservation')]
    private ?SoireeJeu $soireeJeu = null;

    #[ORM\ManyToOne(inversedBy: 'reservation')]
    private ?Utilisateur $utilisateur = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSoireeJeu(): ?SoireeJeu
    {
        return $this->soireeJeu;
    }

    public function setSoireeJeu(?SoireeJeu $soireeJeu): static
    {
        $this->soireeJeu = $soireeJeu;

        return $this;
    }

    public function getUtilisateur(): ?Utilisateur
    {
        return $this->utilisateur;
    }

    public function setUtilisateur(?Utilisateur $utilisateur): static
    {
        $this->utilisateur = $utilisateur;

        return $this;
    }
}
