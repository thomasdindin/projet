<?php

namespace App\Entity;

use App\Repository\StockeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: StockeRepository::class)]
class Stocke
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\OneToMany(mappedBy: 'stocke', targetEntity: Produits::class)]
    private Collection $fk_id_produits;

    #[ORM\OneToMany(mappedBy: 'stocke', targetEntity: Entrepot::class)]
    private Collection $fk_id_entrepot;

    #[ORM\Column]
    private ?int $quantite = null;

    public function __construct()
    {
        $this->fk_id_produits = new ArrayCollection();
        $this->fk_id_entrepot = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection<int, Produits>
     */
    public function getFkIdProduits(): Collection
    {
        return $this->fk_id_produits;
    }

    public function addFkIdProduit(Produits $fkIdProduit): static
    {
        if (!$this->fk_id_produits->contains($fkIdProduit)) {
            $this->fk_id_produits->add($fkIdProduit);
            $fkIdProduit->setStocke($this);
        }

        return $this;
    }

    public function removeFkIdProduit(Produits $fkIdProduit): static
    {
        if ($this->fk_id_produits->removeElement($fkIdProduit)) {
            // set the owning side to null (unless already changed)
            if ($fkIdProduit->getStocke() === $this) {
                $fkIdProduit->setStocke(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Entrepot>
     */
    public function getFkIdEntrepot(): Collection
    {
        return $this->fk_id_entrepot;
    }

    public function addFkIdEntrepot(Entrepot $fkIdEntrepot): static
    {
        if (!$this->fk_id_entrepot->contains($fkIdEntrepot)) {
            $this->fk_id_entrepot->add($fkIdEntrepot);
            $fkIdEntrepot->setStocke($this);
        }

        return $this;
    }

    public function removeFkIdEntrepot(Entrepot $fkIdEntrepot): static
    {
        if ($this->fk_id_entrepot->removeElement($fkIdEntrepot)) {
            // set the owning side to null (unless already changed)
            if ($fkIdEntrepot->getStocke() === $this) {
                $fkIdEntrepot->setStocke(null);
            }
        }

        return $this;
    }

    public function getQuantite(): ?int
    {
        return $this->quantite;
    }

    public function setQuantite(int $quantite): static
    {
        $this->quantite = $quantite;

        return $this;
    }
}
