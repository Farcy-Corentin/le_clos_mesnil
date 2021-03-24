<?php

namespace App\Entity;

use App\Repository\EquipmentRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=EquipmentRepository::class)
 */
class Equipment
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private ?int $id;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private ?string $name;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private ?string $description;

    /**
     * @ORM\ManyToMany(targetEntity=Room::class, inversedBy="equipment")
     */
    private ArrayCollection $room;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private ?string $english_name;

    /**
     * @ORM\Column(type="text")
     */
    private ?string $english_description;

    public function __construct()
    {
        $this->room = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEquName(): ?string
    {
        return $this->name;
    }

    public function setEquName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getEquDescription(): ?string
    {
        return $this->description;
    }

    public function setEquDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Collection
     */
    public function getRoom(): Collection
    {
        return $this->room;
    }

    public function addRoom(room $room): self
    {
        if (!$this->room->contains($room)) {
            $this->room[] = $room;
        }

        return $this;
    }

    public function removeRoom(room $room): self
    {
        $this->room->removeElement($room);

        return $this;
    }

    public function getEquEnglishName(): ?string
    {
        return $this->english_name;
    }

    public function setEquEnglishName(string $english_name): self
    {
        $this->english_name = $english_name;

        return $this;
    }

    public function getEquEnglishDescription(): ?string
    {
        return $this->english_description;
    }

    public function setEquEnglishDescription(string $english_description): self
    {
        $this->english_description = $english_description;

        return $this;
    }
}
