<?php

namespace App\Entity;

use App\Repository\DestinationRepository;
use Doctrine\ORM\Mapping as ORM;
use Vich\UploaderBundle\Entity\File as EmbeddedFile;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: DestinationRepository::class)]
#[Vich\Uploadable]

class Destination
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank]
    private ?string $description = null;

    #[ORM\Column]
    #[Assert\NotBlank]
    private ?float $price = null;

    #[ORM\Column]
    #[Assert\NotBlank]
    private ?int $duration = null;

    #[Assert\File(
        mimeTypes: ["image/png","image/jpeg","image/jpg","image/pjpeg"]
    )]
    #[Vich\UploadableField(mapping: 'destinations', fileNameProperty: 'picture')]
    private ?File $imageFile = null;

    #[ORM\Column(length: 255,nullable: true)]
    private ?string $picture = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
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

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): static
    {
        $this->price = $price;

        return $this;
    }

    public function getDuration(): ?int
    {
        return $this->duration;
    }

    public function setDuration(int $duration): static
    {
        $this->duration = $duration;

        return $this;
    }

    public function getPicture(): ?string
    {
        return $this->picture;
    }

    public function setPicture(?string $picture): static
    {
        $this->picture = $picture;

        return $this;
    }
    public function setImageFile(?File $imageFile = null): static
    {
        $this->imageFile = $imageFile;

        return $this;
    }

    public function getImageFile(): ?File
    {
        return $this->imageFile;
    }
}
