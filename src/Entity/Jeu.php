<?php

namespace App\Entity;

use App\Repository\JeuRepository;
// use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: JeuRepository::class)]
class Jeu
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $titre = null;

    #[ORM\Column(length: 255)]
    private ?string $description = null;

    #[ORM\Column]
    private ?int $duree_moyenne = null;

    #[ORM\ManyToOne(inversedBy: 'jeux')]
    private ?Administrateur $administrateur = null;

    #[ORM\Column]
    private ?int $age_minimum = null;

    #[ORM\Column]
    private ?int $nombre_joueurs = null;

    #[ORM\ManyToOne(inversedBy: 'categories')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Categorie $categorie = null;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getDureeMoyenne(): ?int
    {
        return $this->duree_moyenne;
    }

    public function setDureeMoyenne(int $duree_moyenne): static
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

    public function getAgeMinimum(): ?int
    {
        return $this->age_minimum;
    }

    public function setAgeMinimum(int $age_minimum): static
    {
        $this->age_minimum = $age_minimum;

        return $this;
    }

    public function getNombreJoueurs(): ?int
    {
        return $this->nombre_joueurs;
    }

    public function setNombreJoueurs(int $nombre_joueurs): static
    {
        $this->nombre_joueurs = $nombre_joueurs;

        return $this;
    }

    public function getCategories(): ?Categorie
    {
        return $this->categorie;
    }
    public function setCategorie(?Categorie $categorie)
    {
        $this->categorie = $categorie;

        return $this;
    }
    // /**
    //  * @var Collection<int, Categorie>
    //  */
    // #[ORM\ManyToMany(targetEntity: Categorie::class, inversedBy: 'jeux')]
    // #[ORM\JoinTable(name: 'jeu_categorie')]
    // private Collection $categories;

    // public function __construct() 
    // {
    //     $this->categorie = new ArrayCollection();
    // }
    
    //  /**
    //   * @return Collection<int, Categorie>
    //   */
    

    // public function addCategorie(Categorie $categorie): static
    // {
    //     if (!$this->categorie->contains($categorie)) {
    //         $this->categorie->add($categorie);
    //     }

    //     return $this;
    // }

    // public function removeCategorie(Categorie $categorie): static
    // {
    //     $this->categories->removeElement($categorie);

    //     return $this;
    // }
}
