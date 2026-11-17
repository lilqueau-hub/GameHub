<?php

namespace App\Entity;

use App\Repository\SoireeJeuRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Clock\DatePoint;

#[ORM\Entity(repositoryClass: SoireeJeuRepository::class)]
class SoireeJeu
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 150)]
    private ?string $jeu_associe = null;

    #[ORM\Column(type: 'day_point')]
    private ?DatePoint $date_soiree = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 15, scale: 0)]
    private ?string $nombre_Ãmax_participants = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getJeuAssocie(): ?string
    {
        return $this->jeu_associe;
    }

    public function setJeuAssocie(string $jeu_associe): static
    {
        $this->jeu_associe = $jeu_associe;

        return $this;
    }

    public function getDateSoiree(): ?DatePoint
    {
        return $this->date_soiree;
    }

    public function setDateSoiree(DatePoint $date_soiree): static
    {
        $this->date_soiree = $date_soiree;

        return $this;
    }

    public function getNombreÃmaxParticipants(): ?string
    {
        return $this->nombre_Ãmax_participants;
    }

    public function setNombreÃmaxParticipants(string $nombre_Ãmax_participants): static
    {
        $this->nombre_Ãmax_participants = $nombre_Ãmax_participants;

        return $this;
    }
}
