<?php

namespace App\Entity;

use App\Repository\CategorieRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CategorieRepository::class)]
class Categorie
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $nom_categorie = null;

    #[ORM\ManyToOne(inversedBy: 'categories')]
    private ?Administrateur $administrateur = null;

    // #[ORM\Column(length:50)]
    // private ?string $titre = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomCategorie(): ?string
    {
        return $this->nom_categorie;
    }

    public function setNomCategorie(string $nom_categorie): static
    {
        $this->nom_categorie = $nom_categorie;

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

    /**
     * @var Collection<int, Jeu>
     */
    #[ORM\ManyToMany(targetEntity: Jeu::class, mappedBy: 'categories')]
    private Collection $jeux;

    public function __construct() 
    {
        $this->jeux = new ArrayCollection();
    }

    /**
     * @return Collection<int, Jeu>
     */
    public function getJeux(): Collection
    {
        return $this->jeux;
    }

    public function addJeux(Jeu $jeu): static
    {
        if(!$this->jeux->contains($jeu)) {
            $this->jeux->add($jeu);
            $jeu->addCategorie($this);
        }

        return $this;
    }

    public function removeJeu(Jeu $jeu): static
    {
        if ($this->jeux->removeElement($jeu)) {
            $jeu->removeCategorie($this);
        }

        return $this;
    }
}
