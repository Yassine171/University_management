<?php

namespace App\Entity;

use App\Repository\ProfRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Metadata\ApiResource;

#[ApiResource]
#[ORM\Entity(repositoryClass: ProfRepository::class)]
class Prof
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(type: Types::ARRAY)]
    private array $Modules = [];

    #[ORM\OneToMany(mappedBy: 'encadrant', targetEntity: Etudiant::class)]
    private Collection $etudiants_encadre;

    public function __construct()
    {
        $this->etudiants_encadre = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getModules(): array
    {
        return $this->Modules;
    }

    public function setModules(array $Modules): self
    {
        $this->Modules = $Modules;

        return $this;
    }

    /**
     * @return Collection<int, Etudiant>
     */
    public function getEtudiantsEncadre(): Collection
    {
        return $this->etudiants_encadre;
    }

    public function addEtudiantsEncadre(Etudiant $etudiantsEncadre): self
    {
        if (!$this->etudiants_encadre->contains($etudiantsEncadre)) {
            $this->etudiants_encadre->add($etudiantsEncadre);
            $etudiantsEncadre->setEncadrant($this);
        }

        return $this;
    }

    public function removeEtudiantsEncadre(Etudiant $etudiantsEncadre): self
    {
        if ($this->etudiants_encadre->removeElement($etudiantsEncadre)) {
            // set the owning side to null (unless already changed)
            if ($etudiantsEncadre->getEncadrant() === $this) {
                $etudiantsEncadre->setEncadrant(null);
            }
        }

        return $this;
    }
}
