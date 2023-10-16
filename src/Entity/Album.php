<?php

namespace App\Entity;

use App\Repository\AlbumRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AlbumRepository::class)]
class Album
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $description = null;

    #[ORM\OneToMany(mappedBy: 'album', targetEntity: Rendu::class)]
    private Collection $rendus;

    #[ORM\ManyToOne(inversedBy: 'albums')]
    private ?Membre $membre = null;

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
            $rendu->setAlbum($this);
        }

        return $this;
    }

    public function removeRendu(Rendu $rendu): static
    {
        if ($this->rendus->removeElement($rendu)) {
            // set the owning side to null (unless already changed)
            if ($rendu->getAlbum() === $this) {
                $rendu->setAlbum(null);
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
    public function __toString() 
    {
        $s = '';
        $s .= $this->getId() .' '. $this->getDescription() .' ';
        return $s;
    }

}
