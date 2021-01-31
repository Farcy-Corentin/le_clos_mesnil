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
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $roo_name;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $rou_picture;

    /**
     * @ORM\ManyToOne(targetEntity=gite::class, inversedBy="room")
     * @ORM\JoinColumn(nullable=false)
     */
    private $gite;

    /**
     * @ORM\ManyToMany(targetEntity=Equipment::class, mappedBy="room")
     */
    private $equipment;

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
        return $this->rou_picture;
    }

    public function setRouPicture(?string $rou_picture): self
    {
        $this->rou_picture = $rou_picture;

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

    /**
     * @return Collection|Equipment[]
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
}
