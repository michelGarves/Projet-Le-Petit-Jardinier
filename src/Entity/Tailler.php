<?php

namespace App\Entity;

use App\Repository\TaillerRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TaillerRepository::class)
 */
class Tailler
{
    /**
     * @ORM\ManyToOne(targetEntity=Devis::class, inversedBy="taillers")
     * @ORM\JoinColumn(nullable=false)
     */
    private $noDevis;

    /**
     * @ORM\ManyToOne(targetEntity=Haie::class, inversedBy="taillers")
     * @ORM\JoinColumn(nullable=false)
     */
    private $idHaie;

    /**
     * @ORM\Column(type="string", length=12)
     */
    private $longueur;

    /**
     * @ORM\Column(type="string", length=12)
     */
    private $hauteur;

    /**
     * @ORM\Id
     * @ORM\Column(type="string", length=255)
     */
    private $id;

    public function getNoDevis(): ?Devis
    {
        return $this->noDevis;
    }

    public function setNoDevis($noDevis): self
    {
        $this->noDevis = $noDevis;

        return $this;
    }

    public function getIdHaie(): ?Haie
    {
        return $this->idHaie;
    }

    public function setIdHaie($idHaie): self
    {
        $this->idHaie = $idHaie;

        return $this;
    }

    public function getLongueur(): ?string
    {
        return $this->longueur;
    }
    public function getId(): ?string
    {
        return $this->id;
    }
    public function setLongueur(string $longueur): self
    {
        $this->longueur = $longueur;

        return $this;
    }

    public function getHauteur(): ?string
    {
        return $this->hauteur;
    }

    public function setHauteur(string $hauteur): self
    {
        $this->hauteur = $hauteur;

        return $this;
    }
}
