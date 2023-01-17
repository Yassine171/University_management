<?php

namespace App\Entity;

use ApiPlatform\Doctrine\Orm\Filter\OrderFilter;
use ApiPlatform\Doctrine\Orm\Filter\SearchFilter;
use ApiPlatform\Metadata\ApiFilter;
use App\Repository\EtudiantRepository;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Metadata\ApiResource;

#[ApiResource]
#[ApiResource,
    ApiFilter(
    SearchFilter::class,
    properties: [
        'filiere.name' => SearchFilter::STRATEGY_EXACT,
        'nv_scolaire' => SearchFilter::STRATEGY_EXACT,
        'name' => SearchFilter::STRATEGY_PARTIAL
    ]
    ),
    ApiFilter(
        OrderFilter::class,
        properties: [
            'name'
        ]
    )
    ]
#[ORM\Entity(repositoryClass: EtudiantRepository::class)]
class Etudiant 
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $cv = null;

    #[ORM\Column(length: 255)]
    private ?string $nv_scolaire;


    #[ORM\ManyToOne(inversedBy: 'Stagiaires')]
    private ?Entreprise $entreprise = null;

    #[ORM\ManyToOne(inversedBy: 'etudiants_encadre')]
    private ?Prof $encadrant = null;

    #[ORM\ManyToOne(inversedBy: 'etudiants')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Filiere $filiere;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user = null;

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

    public function getCv(): ?string
    {
        return $this->cv;
    }

    public function setCv(string $cv): self
    {
        $this->cv = $cv;

        return $this;
    }

    public function getNvScolaire(): ?string
    {
        return $this->nv_scolaire;
    }

    public function setNvScolaire(string $nv_scolaire): self
    {
        $this->nv_scolaire = $nv_scolaire;

        return $this;
    }


    public function getEntreprise(): ?Entreprise
    {
        return $this->entreprise;
    }

    public function setEntreprise(?Entreprise $entreprise): self
    {
        $this->entreprise = $entreprise;

        return $this;
    }

    public function getEncadrant(): ?Prof
    {
        return $this->encadrant;
    }

    public function setEncadrant(?Prof $encadrant): self
    {
        $this->encadrant = $encadrant;

        return $this;
    }

    public function getFiliere(): ?Filiere
    {
        return $this->filiere;
    }

    public function setFiliere(?Filiere $filiere): self
    {
        $this->filiere = $filiere;

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
