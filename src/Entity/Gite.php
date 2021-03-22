<?php

namespace App\Entity;

use App\Repository\GiteRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=GiteRepository::class)
 */
class Gite
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private ?int $id;

    /**
     * @ORM\Column(type="string", length=25)
     */
    private ?string $name;

    /**
     * @ORM\Column(type="text")
     */
    private ?string $description;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private ?string $address;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private ?string $city;

    /**
     * @ORM\Column(type="string", length=5)
     */
    private ?string $zipcode;

    /**
     * @ORM\Column(type="string", length=10)
     */
    private ?string $phone;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private ?string $mail;

    /**
     * @ORM\OneToMany(targetEntity=Rule::class, mappedBy="gite")
     */
    private ArrayCollection $rule;

    /**
     * @ORM\OneToMany(targetEntity=Room::class, mappedBy="gite")
     */
    private ArrayCollection $rooms;

    public function __construct()
    {
        $this->rule = new ArrayCollection();
        $this->rooms = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getGitName(): ?string
    {
        return $this->name;
    }

    public function setGitName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getGitDescription(): ?string
    {
        return $this->description;
    }

    public function setGitDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getGitAddress(): ?string
    {
        return $this->address;
    }

    public function setGitAddress(string $address): self
    {
        $this->address = $address;

        return $this;
    }

    public function getGitCity(): ?string
    {
        return $this->city;
    }

    public function setGitCity(string $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function getGitPhone(): ?string
    {
        return $this->phone;
    }

    public function setGitPhone(string $phone): self
    {
        $this->phone = $phone;

        return $this;
    }

    public function getGitMail(): ?string
    {
        return $this->mail;
    }

    public function setGitMail(string $mail): self
    {
        $this->mail = $mail;

        return $this;
    }


    /**
     * @return Collection
     */
    public function getRule(): Collection
    {
        return $this->rule;
    }

    public function addRule(Rule $rule): self
    {
        if (!$this->rule->contains($rule)) {
            $this->rule[] = $rule;
            $rule->setGite($this);
        }

        return $this;
    }

    public function removeRule(Rule $rule): self
    {
        if ($this->rule->removeElement($rule)) {
            // set the owning side to null (unless already changed)
            if ($rule->getGite() === $this) {
                $rule->setGite(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection
     */
    public function getRooms(): Collection
    {
        return $this->rooms;
    }

    public function addRoom(Room $room): self
    {
        if (!$this->rooms->contains($room)) {
            $this->rooms[] = $room;
            $room->setGite($this);
        }

        return $this;
    }

    public function getGitZipcode(): ?string
    {
        return $this->zipcode;
    }

    public function setGitZipcode(string $zipcode): self
    {
        $this->zipcode = $zipcode;

        return $this;
    }
}
