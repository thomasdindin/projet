<?php

namespace App\Entity;

use App\Repository\ContenirRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ContenirRepository::class)]
class Contenir
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $quantite = null;

    #[ORM\Column]
    private ?float $TVA = null;

    #[ORM\Column]
    private ?float $prixUnitaire = null;

    #[ORM\ManyToOne(inversedBy: 'contenirs')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Produits $fkProduitId = null;

    #[ORM\ManyToOne(inversedBy: 'contenirs')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Commande $fkCommandeId = null;

    #[ORM\ManyToOne(inversedBy: 'contenirs')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Entrepot $fkEntrepotId = null;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getTVA(): ?float
    {
        return $this->TVA;
    }

    public function setTVA(float $TVA): static
    {
        $this->TVA = $TVA;

        return $this;
    }

    public function getPrixUnitaire(): ?float
    {
        return $this->prixUnitaire;
    }

    public function setPrixUnitaire(float $prixUnitaire): static
    {
        $this->prixUnitaire = $prixUnitaire;

        return $this;
    }

    public function getFkProduitId(): ?Produits
    {
        return $this->fkProduitId;
    }

    public function setFkProduitId(?Produits $fkProduitId): static
    {
        $this->fkProduitId = $fkProduitId;

        return $this;
    }

    public function getFkCommandeId(): ?Commande
    {
        return $this->fkCommandeId;
    }

    public function setFkCommandeId(?Commande $fkCommandeId): static
    {
        $this->fkCommandeId = $fkCommandeId;

        return $this;
    }

    public function getFkEntrepotId(): ?Entrepot
    {
        return $this->fkEntrepotId;
    }

    public function setFkEntrepotId(?Entrepot $fkEntrepotId): static
    {
        $this->fkEntrepotId = $fkEntrepotId;

        return $this;
    }
}
