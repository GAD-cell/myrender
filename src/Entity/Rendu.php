<?php

namespace App\Entity;

use App\Repository\RenduRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RenduRepository::class)]
class Rendu
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $logiciel = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $moteur_rendu = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $description = null;

    #[ORM\ManyToOne(inversedBy: 'rendus')]
    private ?Album $album = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLogiciel(): ?string
    {
        return $this->logiciel;
    }

    public function setLogiciel(?string $logiciel): static
    {
        $this->logiciel = $logiciel;

        return $this;
    }

    public function getMoteurRendu(): ?string
    {
        return $this->moteur_rendu;
    }

    public function setMoteurRendu(?string $moteur_rendu): static
    {
        $this->moteur_rendu = $moteur_rendu;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getAlbum(): ?Album
    {
        return $this->album;
    }

    public function setAlbum(?Album $album): static
    {
        $this->album = $album;

        return $this;
    }

    public function __toString() 
    {
        $s = '';
        $s .= $this->getId() .' '. $this->getDescription() .' ';
        return $s;
    }
}
