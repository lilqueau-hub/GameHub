<?php

namespace App\Entity;

use App\Repository\JeuRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: JeuRepository::class)]
class Jeu
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $description = null;

    #[ORM\Column]
    private ?\DateTime $duree_moyenne = null;

    #[ORM\ManyToOne(inversedBy: 'jeus')]
    private ?Administrateur $administrateur = null;

    #[ORM\Column]
    private ?bool $age_minimum = null;

    #[ORM\Column]
    private ?bool $nombre_joueurs = null;

    #[ORM\Column(length: 50)]
    private ?string $titre = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getDureeMoyenne(): ?\DateTime
    {
        return $this->duree_moyenne;
    }

    public function setDureeMoyenne(\DateTime $duree_moyenne): static
    {
        $this->duree_moyenne = $duree_moyenne;

        return $this;
    }

    public function getAdministrateur(): ?Administrateur
    {
        return $this->administrateur;
    }

    public function setAdministrateur(?Administrateur $administrateur): static
    {
        $this->administrateur = $administrateur;

        return $this;
    }

    public function isAgeMinimum(): ?bool
    {
        return $this->age_minimum;
    }

    public function setAgeMinimum(bool $age_minimum): static
    {
        $this->age_minimum = $age_minimum;

        return $this;
    }

    public function isNombreJoueurs(): ?bool
    {
        return $this->nombre_joueurs;
    }

    public function setNombreJoueurs(bool $nombre_joueurs): static
    {
        $this->nombre_joueurs = $nombre_joueurs;

        return $this;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): static
    {
        $this->titre = $titre;

        return $this;
    }
}
