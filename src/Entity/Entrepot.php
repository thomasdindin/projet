<?php

namespace App\Entity;

use App\Repository\EntrepotRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EntrepotRepository::class)]
class Entrepot
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $lieu = null;

    #[ORM\ManyToOne(inversedBy: 'fk_id_entrepot')]
    private ?Stocke $stocke = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLieu(): ?string
    {
        return $this->lieu;
    }

    public function setLieu(string $lieu): static
    {
        $this->lieu = $lieu;

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
}
