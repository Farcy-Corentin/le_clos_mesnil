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
    private $id;

    /**
     * @ORM\Column(type="string", length=25)
     */
    private $git_name;

    /**
     * @ORM\Column(type="text")
     */
    private $git_description;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $git_address;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $git_city;

    /**
     * @ORM\Column(type="string", length=10)
     */
    private $git_phone;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $git_mail;

    /**
     * @ORM\OneToMany(targetEntity=Rule::class, mappedBy="gite")
     */
    private $rule;

    /**
     * @ORM\OneToMany(targetEntity=Room::class, mappedBy="gite")
     */
    private $rooms;

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
        return $this->git_name;
    }

    public function setGitName(string $git_name): self
    {
        $this->git_name = $git_name;

        return $this;
    }

    public function getGitDescription(): ?string
    {
        return $this->git_description;
    }

    public function setGitDescription(string $git_description): self
    {
        $this->git_description = $git_description;

        return $this;
    }

    public function getGitAddress(): ?string
    {
        return $this->git_address;
    }

    public function setGitAddress(string $git_address): self
    {
        $this->git_address = $git_address;

        return $this;
    }

    public function getGitCity(): ?string
    {
        return $this->git_city;
    }

    public function setGitCity(string $git_city): self
    {
        $this->git_city = $git_city;

        return $this;
    }

    public function getGitPhone(): ?string
    {
        return $this->git_phone;
    }

    public function setGitPhone(string $git_phone): self
    {
        $this->git_phone = $git_phone;

        return $this;
    }

    public function getGitMail(): ?string
    {
        return $this->git_mail;
    }

    public function setGitMail(string $git_mail): self
    {
        $this->git_mail = $git_mail;

        return $this;
    }



    /**
     * @return Collection|Rule[]
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
     * @return Collection|Room[]
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

    public function removeRoom(Room $room): self
    {
        if ($this->rooms->removeElement($room)) {
            // set the owning side to null (unless already changed)
            if ($room->getGite() === $this) {
                $room->setGite(null);
            }
        }

        return $this;
    }
}
