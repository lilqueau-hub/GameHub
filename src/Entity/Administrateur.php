<?php

namespace App\Entity;

use App\Repository\AdministrateurRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AdministrateurRepository::class)]
class Administrateur
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $Nom = null;

    #[ORM\Column(length: 50)]
    private ?string $Prenom = null;

    /**
     * @var Collection<int, Jeu>
     */
    #[ORM\OneToMany(targetEntity: Jeu::class, mappedBy: 'administrateur')]
    private Collection $jeus;

    /**
     * @var Collection<int, Categorie>
     */
    #[ORM\OneToMany(targetEntity: Categorie::class, mappedBy: 'administrateur')]
    private Collection $categories;

    public function __construct()
    {
        $this->jeus = new ArrayCollection();
        $this->categories = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->Nom;
    }

    public function setNom(string $Nom): static
    {
        $this->Nom = $Nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->Prenom;
    }

    public function setPrenom(string $Prenom): static
    {
        $this->Prenom = $Prenom;

        return $this;
    }

    /**
     * @return Collection<int, Jeu>
     */
    public function getJeus(): Collection
    {
        return $this->jeus;
    }

    public function addJeu(Jeu $jeu): static
    {
        if (!$this->jeus->contains($jeu)) {
            $this->jeus->add($jeu);
            $jeu->setAdministrateur($this);
        }

        return $this;
    }

    public function removeJeu(Jeu $jeu): static
    {
        if ($this->jeus->removeElement($jeu)) {
            // set the owning side to null (unless already changed)
            if ($jeu->getAdministrateur() === $this) {
                $jeu->setAdministrateur(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Categorie>
     */
    public function getCategories(): Collection
    {
        return $this->categories;
    }

    public function addCategory(Categorie $category): static
    {
        if (!$this->categories->contains($category)) {
            $this->categories->add($category);
            $category->setAdministrateur($this);
        }

        return $this;
    }

    public function removeCategory(Categorie $category): static
    {
        if ($this->categories->removeElement($category)) {
            // set the owning side to null (unless already changed)
            if ($category->getAdministrateur() === $this) {
                $category->setAdministrateur(null);
            }
        }

        return $this;
    }
}
