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
    private ?string $equ_name;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private ?string $equ_description;

    /**
     * @ORM\ManyToMany(targetEntity=Room::class, inversedBy="equipment")
     */
    private ArrayCollection $room;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private ?string $equ_english_name;

    /**
     * @ORM\Column(type="text")
     */
    private ?string $equ_english_description;

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
        return $this->equ_name;
    }

    public function setEquName(string $equ_name): self
    {
        $this->equ_name = $equ_name;

        return $this;
    }

    public function getEquDescription(): ?string
    {
        return $this->equ_description;
    }

    public function setEquDescription(?string $equ_description): self
    {
        $this->equ_description = $equ_description;

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
        return $this->equ_english_name;
    }

    public function setEquEnglishName(string $equ_english_name): self
    {
        $this->equ_english_name = $equ_english_name;

        return $this;
    }

    public function getEquEnglishDescription(): ?string
    {
        return $this->equ_english_description;
    }

    public function setEquEnglishDescription(string $equ_english_description): self
    {
        $this->equ_english_description = $equ_english_description;

        return $this;
    }
}
