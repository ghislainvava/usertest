<?php

namespace App\Entity;

use App\Repository\ProductRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Vich\UploaderBundle\Mapping\Annotation as Vich; //ajouté
use Symfony\Component\HttpFoundation\File\File;  //ajouté

#[Vich\Uploadable] //ajouté
#[ORM\Entity(repositoryClass: ProductRepository::class)]
class Product
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $descript = null;

    #[ORM\Column(nullable: true)]
    private ?int $quantity = null;

    #[ORM\Column(type: "string", length: 255, nullable: true)]
    private ?string $imageName = null; //ajouté

    #[Vich\UploadableField(mapping: "product_image", fileNameProperty: "imageName")]
    private $imageFile; //ajouté

    #[ORM\Column(type: "datetime_immutable", nullable: true)]
    private ?\DateTimeImmutable $updatedAt = null; //ajouté


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

    public function getDescript(): ?string
    {
        return $this->descript;
    }

    public function setDescript(string $descript): self
    {
        $this->descript = $descript;

        return $this;
    }

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity(?int $quantity): self
    {
        $this->quantity = $quantity;

        return $this;
    }

    public function getImageName(): ?string //ajouté
    {
        return $this->imageName;
    }

    public function setImageName(?string $imageName): self //ajouté
    {
        $this->imageName = $imageName;

        return $this;
    }

    public function setImageFile(?File $imageFile = null): self //ajouté
    {
        $this->imageFile = $imageFile;
        if ($imageFile) {
            $this->updatedAt = new \DateTimeImmutable();
        }
        return $this;
    }

    public function getImageFile(): ?File //ajouté
    {
        return $this->imageFile;
    }
    public function getUpdatedAt(): ?\DateTimeImmutable //ajouté
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?\DateTimeImmutable $updatedAt): self //ajouté
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }
}
