<?php

namespace App\Entity;

use App\Repository\JeuRepository;
use Doctrine\Common\Collections\ArrayCollection;
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

    #[ORM\Column]
    private ?int $age_minimum = null;

    #[ORM\Column]
    private ?int $nombre_joueurs = null;

    #[ORM\ManyToOne(inversedBy: 'jeux')]
    private ?Administrateur $administrateur = null;

    /**
     * @var Collection<int, Categorie>
     */
    #[ORM\ManyToMany(targetEntity: Categorie::class, inversedBy: 'jeux')]
    #[ORM\JoinTable(name: 'jeu_categorie')]
    private Collection $categories;

    /**
     * @var Collection<int, SoireeJeu>
     */
    #[ORM\OneToMany(targetEntity: SoireeJeu::class, mappedBy: 'jeusoiree')]
    private Collection $soireeJeus;

    public function __construct()
    {
        $this->categories = new ArrayCollection();
        $this->soireeJeus = new ArrayCollection();
    }

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
     * @return Collection<int, Categorie>
     */
    public function getCategories(): Collection
    {
        return $this->categories;
    }

    public function addCategorie(Categorie $categorie): static
    {
        if (!$this->categories->contains($categorie)) {
            $this->categories->add($categorie);
        }

        return $this;
    }

    public function removeCategorie(Categorie $categorie): static
    {
        $this->categories->removeElement($categorie);

        return $this;
    }

    /**
     * @return Collection<int, SoireeJeu>
     */
    public function getSoireeJeus(): Collection
    {
        return $this->soireeJeus;
    }

    public function addSoireeJeu(SoireeJeu $soireeJeu): static
    {
        if (!$this->soireeJeus->contains($soireeJeu)) {
            $this->soireeJeus->add($soireeJeu);
            $soireeJeu->setJeusoiree($this);
        }

        return $this;
    }

    public function removeSoireeJeu(SoireeJeu $soireeJeu): static
    {
        if ($this->soireeJeus->removeElement($soireeJeu)) {
            // set the owning side to null (unless already changed)
            if ($soireeJeu->getJeusoiree() === $this) {
                $soireeJeu->setJeusoiree(null);
            }
        }

        return $this;
    }
}
