<?php

namespace App\Entity;

use App\Repository\ExisteRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ExisteRepository::class)]
class Existe
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $quantite = null;

    #[ORM\ManyToOne(inversedBy: 'existes')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Produits $fkProduitId = null;

    #[ORM\ManyToOne(inversedBy: 'existes')]
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

    public function getFkProduitId(): ?Produits
    {
        return $this->fkProduitId;
    }

    public function setFkProduitId(?Produits $fkProduitId): static
    {
        $this->fkProduitId = $fkProduitId;

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