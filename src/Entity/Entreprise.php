<?php

namespace App\Entity;

use App\Repository\EntrepriseRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Metadata\ApiResource;
use App\Entity\User;

#[ApiResource]
#[ORM\Entity(repositoryClass: EntrepriseRepository::class)]
class Entreprise
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\OneToMany(mappedBy: 'entreprise', targetEntity: Etudiant::class)]
    private Collection $Stagiaires;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user = null;

    public function __construct()
    {
        $this->Stagiaires = new ArrayCollection();
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

    /**
     * @return Collection<int, Etudiant>
     */
    public function getStagiaires(): Collection
    {
        return $this->Stagiaires;
    }

    public function addStagiaire(Etudiant $stagiaire): self
    {
        if (!$this->Stagiaires->contains($stagiaire)) {
            $this->Stagiaires->add($stagiaire);
            $stagiaire->setEntreprise($this);
        }

        return $this;
    }

    public function removeStagiaire(Etudiant $stagiaire): self
    {
        if ($this->Stagiaires->removeElement($stagiaire)) {
            // set the owning side to null (unless already changed)
            if ($stagiaire->getEntreprise() === $this) {
                $stagiaire->setEntreprise(null);
            }
        }

        return $this;
    }

    public function getUserId(): ?User
    {
        return $this->user;
    }

    public function setUserId(User $user): self
    {
        $this->user = $user;

        return $this;
    }
}
