<?php

namespace App\Entity;

use App\Repository\HaieRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=HaieRepository::class)
 */
class Haie
{

    /** 
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="smallint")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $code;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom;

    /**
     * @ORM\Column(type="decimal", precision=7, scale=2)
     */
    private $prix;

    /**
     * @ORM\ManyToOne(targetEntity=Categorie::class, inversedBy="haies")
     * @ORM\JoinColumn(nullable=false)
     */
    private $categorie;

    /**
     * @ORM\OneToMany(targetEntity=Tailler::class, mappedBy="idHaie")
     */
    private $taillers;

    

    public function __construct()
    {
        $this->taillers = new ArrayCollection();
    }

    

    /**
     * ACCESSEURS
     */

    public function getCode(): ?string
    {
        return $this->code;
    }


    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function getPrix(): ?string
    {
        return $this->prix;
    }

    /**
     * MUTATEURS
     */

    public function setCode(string $code): self
    {
        $this->code = $code;

        return $this;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

   
    public function setPrix(string $prix): self
    {
        $this->prix = $prix;

        return $this;
    }

    public function getCategorie(): ?Categorie
    {
        return $this->categorie;
    }

    public function setCategorie(?Categorie $categorie): self
    {
        $this->categorie = $categorie;

        return $this;
    }

    /**
     * @return Collection|Tailler[]
     */
    public function getTaillers(): Collection
    {
        return $this->taillers;
    }

    public function addTailler(Tailler $tailler): self
    {
        if (!$this->taillers->contains($tailler)) {
            $this->taillers[] = $tailler;
            $tailler->setIdHaie($this);
        }

        return $this;
    }

    public function removeTailler(Tailler $tailler): self
    {
        if ($this->taillers->removeElement($tailler)) {
            // set the owning side to null (unless already changed)
            if ($tailler->getIdHaie() === $this) {
                $tailler->setIdHaie(null);
            }
        }

        return $this;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): self
    {
        $this->id = $id;

        return $this;
    }

}
