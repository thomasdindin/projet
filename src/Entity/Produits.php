<?php

namespace App\Entity;

use App\Repository\ProduitsRepository;
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

    #[ORM\Column(length: 255)]
    private ?string $description = null;

    #[ORM\Column]
    private ?float $prix = null;

    #[ORM\Column(length: 255)]
    private ?string $image = null;

    #[ORM\Column(length: 20)]
    private ?string $taille = null;

    #[ORM\ManyToOne(inversedBy: 'fk_id_produits')]
    private ?Contient $contient = null;

    #[ORM\ManyToOne(inversedBy: 'fk_id_produits')]
    private ?Stocke $stocke = null;

    #[ORM\ManyToOne(inversedBy: 'produits')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Categories $fkIdCategorie = null;


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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

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

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): static
    {
        $this->image = $image;

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

    public function getContient(): ?Contient
    {
        return $this->contient;
    }

    public function setContient(?Contient $contient): static
    {
        $this->contient = $contient;

        return $this;
    }

    public function getStocke(): ?Stocke
    {
        return $this->stocke;
    }

    public function setStocke(?Stocke $stocke): static
    {
        $this->stocke = $stocke;

        return $this;
    }

    public function getFkIdCategorie(): ?Categories
    {
        return $this->fkIdCategorie;
    }

    public function setFkIdCategorie(?Categories $fkIdCategorie): static
    {
        $this->fkIdCategorie = $fkIdCategorie;

        return $this;
    }

}