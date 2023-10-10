<?php

namespace App\Entity;

use App\Repository\StockerRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: StockerRepository::class)]
class Stocker
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $quantite = null;

    #[ORM\ManyToOne(inversedBy: 'stockers')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Produits $fkProduitId = null;

    #[ORM\ManyToOne(inversedBy: 'stockers')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Magasin $fkMagasinId = null;

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

    public function getFkProduitId(): ?Produits
    {
        return $this->fkProduitId;
    }

    public function setFkProduitId(?Produits $fkProduitId): static
    {
        $this->fkProduitId = $fkProduitId;

        return $this;
    }

    public function getFkMagasinId(): ?Magasin
    {
        return $this->fkMagasinId;
    }

    public function setFkMagasinId(?Magasin $fkMagasinId): static
    {
        $this->fkMagasinId = $fkMagasinId;

        return $this;
    }
}
