<?php

namespace App\Entity;

use App\Repository\ProduitsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProduitsRepository::class)]
class Produits
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(length: 10)]
    private ?string $taille = null;

    #[ORM\Column]
    private ?float $prix = null;

    #[ORM\Column(length: 255)]
    private ?string $description = null;

    #[ORM\ManyToOne(inversedBy: 'produits')]
    #[ORM\JoinColumn(nullable: false)]
    private ?rayon $rayonId = null;

    #[ORM\OneToMany(mappedBy: 'fkProduitId', targetEntity: Stocker::class)]
    private Collection $stockers;

    #[ORM\OneToMany(mappedBy: 'fkProduitId', targetEntity: Contenir::class)]
    private Collection $contenirs;

    #[ORM\OneToMany(mappedBy: 'fkProduitId', targetEntity: Existe::class)]
    private Collection $existes;


    public function __construct()
    {
        $this->fkRayonId = new ArrayCollection();
        $this->stockers = new ArrayCollection();
        $this->contenirs = new ArrayCollection();
        $this->existes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

    public function getTaille(): ?string
    {
        return $this->taille;
    }

    public function setTaille(string $taille): static
    {
        $this->taille = $taille;

        return $this;
    }

    public function getPrix(): ?float
    {
        return $this->prix;
    }

    public function setPrix(float $prix): static
    {
        $this->prix = $prix;

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

    public function getRayonId(): ?rayon
    {
        return $this->rayonId;
    }

    public function setRayonId(?rayon $rayonId): static
    {
        $this->rayonId = $rayonId;

        return $this;
    }

    /**
     * @return Collection<int, Stocker>
     */
    public function getStockers(): Collection
    {
        return $this->stockers;
    }

    public function addStocker(Stocker $stocker): static
    {
        if (!$this->stockers->contains($stocker)) {
            $this->stockers->add($stocker);
            $stocker->setFkProduitId($this);
        }

        return $this;
    }

    public function removeStocker(Stocker $stocker): static
    {
        if ($this->stockers->removeElement($stocker)) {
            // set the owning side to null (unless already changed)
            if ($stocker->getFkProduitId() === $this) {
                $stocker->setFkProduitId(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Contenir>
     */
    public function getContenirs(): Collection
    {
        return $this->contenirs;
    }

    public function addContenir(Contenir $contenir): static
    {
        if (!$this->contenirs->contains($contenir)) {
            $this->contenirs->add($contenir);
            $contenir->setFkProduitId($this);
        }

        return $this;
    }

    public function removeContenir(Contenir $contenir): static
    {
        if ($this->contenirs->removeElement($contenir)) {
            // set the owning side to null (unless already changed)
            if ($contenir->getFkProduitId() === $this) {
                $contenir->setFkProduitId(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Existe>
     */
    public function getExistes(): Collection
    {
        return $this->existes;
    }

    public function addExiste(Existe $existe): static
    {
        if (!$this->existes->contains($existe)) {
            $this->existes->add($existe);
            $existe->setFkProduitId($this);
        }

        return $this;
    }

    public function removeExiste(Existe $existe): static
    {
        if ($this->existes->removeElement($existe)) {
            // set the owning side to null (unless already changed)
            if ($existe->getFkProduitId() === $this) {
                $existe->setFkProduitId(null);
            }
        }

        return $this;
    }

}