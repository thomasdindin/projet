<?php

namespace App\Entity;

use App\Repository\EntrepotRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EntrepotRepository::class)]
class Entrepot
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $adresse = null;

    #[ORM\Column(length: 100)]
    private ?string $ville = null;

    #[ORM\Column]
    private ?int $codePostal = null;

    #[ORM\OneToMany(mappedBy: 'fkEntrepotId', targetEntity: Contenir::class)]
    private Collection $contenirs;

    #[ORM\OneToMany(mappedBy: 'fkEntrepotId', targetEntity: Existe::class)]
    private Collection $existes;

    public function __construct()
    {
        $this->contenirs = new ArrayCollection();
        $this->existes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): static
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getVille(): ?string
    {
        return $this->ville;
    }

    public function setVille(string $ville): static
    {
        $this->ville = $ville;

        return $this;
    }

    public function getCodePostal(): ?int
    {
        return $this->codePostal;
    }

    public function setCodePostal(int $codePostal): static
    {
        $this->codePostal = $codePostal;

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
            $contenir->setFkEntrepotId($this);
        }

        return $this;
    }

    public function removeContenir(Contenir $contenir): static
    {
        if ($this->contenirs->removeElement($contenir)) {
            // set the owning side to null (unless already changed)
            if ($contenir->getFkEntrepotId() === $this) {
                $contenir->setFkEntrepotId(null);
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
            $existe->setFkEntrepotId($this);
        }

        return $this;
    }

    public function removeExiste(Existe $existe): static
    {
        if ($this->existes->removeElement($existe)) {
            // set the owning side to null (unless already changed)
            if ($existe->getFkEntrepotId() === $this) {
                $existe->setFkEntrepotId(null);
            }
        }

        return $this;
    }
}
