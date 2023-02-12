<?php

namespace App\Entity;

use App\Repository\ArtistsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: ArtistsRepository::class)]
class Artists
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank()]
    #[Assert\Length(min:2, max:255)]
    private ?string $name = null;

    #[ORM\Column(nullable: true)]
    private ?int $listeners = null;

    #[ORM\Column]
    private ?bool $is_valid = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $description = null;

    #[ORM\Column(length: 255)]
    private ?string $pathPicture = null;

    #[ORM\Column(nullable: true)]
    private ?int $followers = null;

    #[ORM\ManyToMany(targetEntity: Albums::class)]
    private Collection $albums;

    public function __construct()
    {
        $this->albums = new ArrayCollection();
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

    public function getListeners(): ?int
    {
        return $this->listeners;
    }

    public function setListeners(?int $listeners): self
    {
        $this->listeners = $listeners;

        return $this;
    }

    public function isIsValid(): ?bool
    {
        return $this->is_valid;
    }

    public function setIsValid(bool $is_valid): self
    {
        $this->is_valid = $is_valid;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

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

    public function getFollowers(): ?int
    {
        return $this->followers;
    }

    public function setFollowers(?int $followers): self
    {
        $this->followers = $followers;

        return $this;
    }

    /**
     * @return Collection<int, Albums>
     */
    public function getAlbums(): Collection
    {
        return $this->albums;
    }

    public function addAlbum(Albums $album): self
    {
        if (!$this->albums->contains($album)) {
            $this->albums->add($album);
        }

        return $this;
    }

    public function removeAlbum(Albums $album): self
    {
        $this->albums->removeElement($album);

        return $this;
    }
}
