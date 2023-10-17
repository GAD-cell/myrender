<?php

namespace App\Entity;

use App\Repository\ArtBoardRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ArtBoardRepository::class)]
class ArtBoard
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $description = null;

    #[ORM\Column]
    private ?bool $publiee = null;

    #[ORM\ManyToOne(inversedBy: 'artboards')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Membre $createur = null;

    #[ORM\ManyToMany(targetEntity: Rendu::class, inversedBy: 'artboards')]
    private Collection $rendus;

    public function __construct()
    {
        $this->rendus = new ArrayCollection();
    }

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

    public function isPubliee(): ?bool
    {
        return $this->publiee;
    }

    public function setPubliee(bool $publiee): static
    {
        $this->publiee = $publiee;

        return $this;
    }

    public function getCreateur(): ?Membre
    {
        return $this->createur;
    }

    public function setCreateur(?Membre $createur): static
    {
        $this->createur = $createur;

        return $this;
    }

    /**
     * @return Collection<int, Rendu>
     */
    public function getRendus(): Collection
    {
        return $this->rendus;
    }

    public function addRendu(Rendu $rendu): static
    {
        if (!$this->rendus->contains($rendu)) {
            $this->rendus->add($rendu);
        }

        return $this;
    }

    public function removeRendu(Rendu $rendu): static
    {
        $this->rendus->removeElement($rendu);

        return $this;
    }
}
