<?php

namespace App\Entity;

use App\Repository\CommandesRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CommandesRepository::class)]
class Commandes
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $date_commande = null;

    #[ORM\Column(length: 255)]
    private ?string $lieu_exp = null;

    #[ORM\Column(length: 255)]
    private ?string $lieu_liv = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Etat $fk_id_etat = null;

    #[ORM\ManyToOne(inversedBy: 'fk_id_commandes')]
    private ?Contient $contient = null;

    #[ORM\ManyToOne(inversedBy: 'commandes')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $fkIdUser = null;




    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateCommande(): ?\DateTimeImmutable
    {
        return $this->date_commande;
    }

    public function setDateCommande(\DateTimeImmutable $date_commande): static
    {
        $this->date_commande = $date_commande;

        return $this;
    }

    public function getLieuExp(): ?string
    {
        return $this->lieu_exp;
    }

    public function setLieuExp(string $lieu_exp): static
    {
        $this->lieu_exp = $lieu_exp;

        return $this;
    }

    public function getLieuLiv(): ?string
    {
        return $this->lieu_liv;
    }

    public function setLieuLiv(string $lieu_liv): static
    {
        $this->lieu_liv = $lieu_liv;

        return $this;
    }


    public function getFkIdEtat(): ?Etat
    {
        return $this->fk_id_etat;
    }

    public function setFkIdEtat(?Etat $fk_id_etat): static
    {
        $this->fk_id_etat = $fk_id_etat;

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

    public function getFkIdUser(): ?User
    {
        return $this->fkIdUser;
    }

    public function setFkIdUser(?User $fkIdUser): static
    {
        $this->fkIdUser = $fkIdUser;

        return $this;
    }


}