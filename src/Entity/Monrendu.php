<?php

namespace App\Entity;

use App\Repository\MonrenduRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MonrenduRepository::class)]
class Monrendu
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $description = null;

    #[ORM\Column(length: 255)]
    private ?string $logiciel = null;

    #[ORM\Column(length: 255)]
    private ?string $moteur_rendu = null;

    #[ORM\ManyToOne(inversedBy: 'monrendu')]
    private ?Rendus $rendus = null;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getLogiciel(): ?string
    {
        return $this->logiciel;
    }

    public function setLogiciel(string $logiciel): static
    {
        $this->logiciel = $logiciel;

        return $this;
    }

    public function getMoteurRendu(): ?string
    {
        return $this->moteur_rendu;
    }

    public function setMoteurRendu(string $moteur_rendu): static
    {
        $this->moteur_rendu = $moteur_rendu;

        return $this;
    }

    public function getRendus(): ?Rendus
    {
        return $this->rendus;
    }

    public function setRendus(?Rendus $rendus): static
    {
        $this->rendus = $rendus;

        return $this;
    }
}
