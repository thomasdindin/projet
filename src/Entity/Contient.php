<?php

namespace App\Entity;

use App\Repository\ContientRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ContientRepository::class)]
class Contient
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\OneToMany(mappedBy: 'contient', targetEntity: Produits::class)]
    private Collection $fk_id_produits;

    #[ORM\OneToMany(mappedBy: 'contient', targetEntity: Commandes::class)]
    private Collection $fk_id_commandes;

    #[ORM\Column]
    private ?float $prix_unitaire = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 5, scale: 2)]
    private ?string $TVA = null;

    #[ORM\Column]
    private ?int $quantite = null;


    public function __construct()
    {
        $this->fk_id_produits = new ArrayCollection();
        $this->fk_id_commandes = new ArrayCollection();
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
            $fkIdProduit->setContient($this);
        }

        return $this;
    }

    public function removeFkIdProduit(Produits $fkIdProduit): static
    {
        if ($this->fk_id_produits->removeElement($fkIdProduit)) {
            // set the owning side to null (unless already changed)
            if ($fkIdProduit->getContient() === $this) {
                $fkIdProduit->setContient(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Commandes>
     */
    public function getFkIdCommandes(): Collection
    {
        return $this->fk_id_commandes;
    }

    public function addFkIdCommande(Commandes $fkIdCommande): static
    {
        if (!$this->fk_id_commandes->contains($fkIdCommande)) {
            $this->fk_id_commandes->add($fkIdCommande);
            $fkIdCommande->setContient($this);
        }

        return $this;
    }

    public function removeFkIdCommande(Commandes $fkIdCommande): static
    {
        if ($this->fk_id_commandes->removeElement($fkIdCommande)) {
            // set the owning side to null (unless already changed)
            if ($fkIdCommande->getContient() === $this) {
                $fkIdCommande->setContient(null);
            }
        }

        return $this;
    }

    public function getPrixUnitaire(): ?float
    {
        return $this->prix_unitaire;
    }

    public function setPrixUnitaire(float $prix_unitaire): static
    {
        $this->prix_unitaire = $prix_unitaire;

        return $this;
    }

    public function getTVA(): ?string
    {
        return $this->TVA;
    }

    public function setTVA(string $TVA): static
    {
        $this->TVA = $TVA;

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
