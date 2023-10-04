<?php

namespace App\Entity;

use App\Repository\RendusRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RendusRepository::class)]
class Rendus
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $description = null;

    #[ORM\OneToMany(mappedBy: 'rendus', targetEntity: Monrendu::class)]
    private Collection $monrendu;

    #[ORM\ManyToOne(inversedBy: 'tags')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Membre $membre = null;

    public function __construct()
    {
        $this->monrendu = new ArrayCollection();
    }

    public function __toString() 
    {
        $s = '';
        $s .= $this->getId() .' '. $this->getDescription() .' ';
        return $s;
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

    /**
     * @return Collection<int, Monrendu>
     */
    public function getMonrendu(): Collection
    {
        return $this->monrendu;
    }

    public function addMonrendu(Monrendu $monrendu): static
    {
        if (!$this->monrendu->contains($monrendu)) {
            $this->monrendu->add($monrendu);
            $monrendu->setRendus($this);
        }

        return $this;
    }

    public function removeMonrendu(Monrendu $monrendu): static
    {
        if ($this->monrendu->removeElement($monrendu)) {
            // set the owning side to null (unless already changed)
            if ($monrendu->getRendus() === $this) {
                $monrendu->setRendus(null);
            }
        }

        return $this;
    }

    public function getMembre(): ?Membre
    {
        return $this->membre;
    }

    public function setMembre(?Membre $membre): static
    {
        $this->membre = $membre;

        return $this;
    }
}
