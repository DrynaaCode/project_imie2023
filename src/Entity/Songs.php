<?php

namespace App\Entity;

use App\Repository\SongsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SongsRepository::class)]
class Songs
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\Column(nullable: true)]
    private ?int $listening = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $release_at = null;

    #[ORM\Column(type: Types::TIME_MUTABLE)]
    private ?\DateTimeInterface $duration = null;

    #[ORM\Column(length: 255)]
    private ?string $pathPicture = null;

    #[ORM\Column]
    private ?bool $active = null;

    #[ORM\ManyToOne(inversedBy: 'songs')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Genres $song_type = null;

    #[ORM\ManyToMany(targetEntity: Playlists::class, mappedBy: 'songs')]
    private Collection $playlists;

    #[ORM\ManyToOne(inversedBy: 'songs')]
    private ?Albums $albums = null;

    public function __construct()
    {
        $this->playlists = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getListening(): ?int
    {
        return $this->listening;
    }

    public function setListening(?int $listening): self
    {
        $this->listening = $listening;

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

    public function getDuration(): ?\DateTimeInterface
    {
        return $this->duration;
    }

    public function setDuration(\DateTimeInterface $duration): self
    {
        $this->duration = $duration;

        return $this;
    }

    public function getPathPicture(): ?string
    {
        return $this->pathPicture;
    }

    public function setPathPicture(string $pathPicture): self
    {
        $this->pathPicture = $pathPicture;

        return $this;
    }

    public function isActive(): ?bool
    {
        return $this->active;
    }

    public function setActive(bool $active): self
    {
        $this->active = $active;

        return $this;
    }

    public function getSongType(): ?Genres
    {
        return $this->song_type;
    }

    public function setSongType(?Genres $song_type): self
    {
        $this->song_type = $song_type;

        return $this;
    }

    /**
     * @return Collection<int, Playlists>
     */
    public function getPlaylists(): Collection
    {
        return $this->playlists;
    }

    public function addPlaylist(Playlists $playlist): self
    {
        if (!$this->playlists->contains($playlist)) {
            $this->playlists->add($playlist);
            $playlist->addSong($this);
        }

        return $this;
    }

    public function removePlaylist(Playlists $playlist): self
    {
        if ($this->playlists->removeElement($playlist)) {
            $playlist->removeSong($this);
        }

        return $this;
    }

    public function getAlbums(): ?Albums
    {
        return $this->albums;
    }

    public function setAlbums(?Albums $albums): self
    {
        $this->albums = $albums;

        return $this;
    }
}
