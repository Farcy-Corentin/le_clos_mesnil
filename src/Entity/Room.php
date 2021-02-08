<?php

namespace App\Entity;

use App\Repository\RoomRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=RoomRepository::class)
 */
class Room
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
    private ?string $roo_name;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private ?string $roo_picture;

    /**
     * @ORM\ManyToMany(targetEntity=Equipment::class, mappedBy="room")
     */
    private ArrayCollection $equipment;

    /**
     * @ORM\ManyToOne(targetEntity=Gite::class, inversedBy="rooms")
     * @ORM\JoinColumn(nullable=false)
     */
    private ?gite $gite;

    public function __construct()
    {
        $this->equipment = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRooName(): ?string
    {
        return $this->roo_name;
    }

    public function setRooName(string $roo_name): self
    {
        $this->roo_name = $roo_name;

        return $this;
    }

    public function getRouPicture(): ?string
    {
        return $this->roo_picture;
    }

    public function setRouPicture(?string $roo_picture): self
    {
        $this->roo_picture = $roo_picture;

        return $this;
    }

    /**
     * @return Collection
     */
    public function getEquipment(): Collection
    {
        return $this->equipment;
    }

    public function addEquipment(Equipment $equipment): self
    {
        if (!$this->equipment->contains($equipment)) {
            $this->equipment[] = $equipment;
            $equipment->addRoom($this);
        }

        return $this;
    }

    public function removeEquipment(Equipment $equipment): self
    {
        if ($this->equipment->removeElement($equipment)) {
            $equipment->removeRoom($this);
        }

        return $this;
    }

    public function getGite(): ?gite
    {
        return $this->gite;
    }

    public function setGite(?gite $gite): self
    {
        $this->gite = $gite;

        return $this;
    }
}
