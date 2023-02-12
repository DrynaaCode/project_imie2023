<?php

namespace App\Entity;

use App\Repository\AlbumsRepository;
use DateTimeImmutable;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: AlbumsRepository::class)]
class Albums
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank()]
    #[Assert\Length(min:2, max:255)]
    private ?string $name = null;

    #[ORM\Column]
    #[Assert\NotNull()]
    private ?\DateTimeImmutable $release_at = null;

    #[ORM\OneToMany(mappedBy: 'albums', targetEntity: Songs::class)]
    private Collection $songs;

    public function __construct()
    {
        $this->songs = new ArrayCollection();
        $this->release_at = new DateTimeImmutable();
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

    public function getReleaseAt(): ?\DateTimeImmutable
    {
        return $this->release_at;
    }

    public function setReleaseAt(\DateTimeImmutable $release_at): self
    {
        $this->release_at = $release_at;

        return $this;
    }

    /**
     * @return Collection<int, Songs>
     */
    public function getSongs(): Collection
    {
        return $this->songs;
    }

    public function addSong(Songs $song): self
    {
        if (!$this->songs->contains($song)) {
            $this->songs->add($song);
            $song->setAlbums($this);
        }

        return $this;
    }

    public function removeSong(Songs $song): self
    {
        if ($this->songs->removeElement($song)) {
            // set the owning side to null (unless already changed)
            if ($song->getAlbums() === $this) {
                $song->setAlbums(null);
            }
        }

        return $this;
    }
}
