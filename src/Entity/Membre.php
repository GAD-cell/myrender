<?php

namespace App\Entity;

use App\Repository\MembreRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MembreRepository::class)]
class Membre
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $description = null;

    #[ORM\OneToMany(mappedBy: 'membre', targetEntity: Album::class)]
    private Collection $albums;

    #[ORM\OneToMany(mappedBy: 'createur', targetEntity: ArtBoard::class, orphanRemoval: true)]
    private Collection $artboards;

    public function __construct()
    {
        $this->albums = new ArrayCollection();
        $this->artboards = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    /**
     * @return Collection<int, Album>
     */
    public function getAlbums(): Collection
    {
        return $this->albums;
    }

    public function addAlbum(Album $album): static
    {
        if (!$this->albums->contains($album)) {
            $this->albums->add($album);
            $album->setMembre($this);
        }

        return $this;
    }

    public function removeAlbum(Album $album): static
    {
        if ($this->albums->removeElement($album)) {
            // set the owning side to null (unless already changed)
            if ($album->getMembre() === $this) {
                $album->setMembre(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, ArtBoard>
     */
    public function getArtboards(): Collection
    {
        return $this->artboards;
    }

    public function addArtboard(ArtBoard $artboard): static
    {
        if (!$this->artboards->contains($artboard)) {
            $this->artboards->add($artboard);
            $artboard->setCreateur($this);
        }

        return $this;
    }

    public function removeArtboard(ArtBoard $artboard): static
    {
        if ($this->artboards->removeElement($artboard)) {
            // set the owning side to null (unless already changed)
            if ($artboard->getCreateur() === $this) {
                $artboard->setCreateur(null);
            }
        }

        return $this;
    }

    public function __toString() 
    {
        $s = '';
        $s .= $this->getId() .' '. $this->getDescription() .' ';
        return $s;
    }

}
