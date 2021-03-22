<?php

namespace App\Entity;

use App\Repository\SeasonRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SeasonRepository::class)
 */
class Season
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private ?int $id;

    /**
     * @ORM\Column(type="integer")
     */
    private ?int $sea_price;

    /**
     * @ORM\Column(type="date")
     */
    private ?\DateTimeInterface $sea_date_start;

    /**
     * @ORM\Column(type="date")
     */
    private ?\DateTimeInterface $sea_date_end;

    /**
     * @ORM\OneToMany(targetEntity=Reservation::class, mappedBy="season")
     */
    private ArrayCollection $season;

    /**
     * @ORM\Column(type="string", length=25)
     */
    private ?string $sea_name;

    public function __construct()
    {
        $this->season = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSeaPrice(): ?int
    {
        return $this->sea_price;
    }

    public function setSeaPrice(int $sea_price): self
    {
        $this->sea_price = $sea_price;

        return $this;
    }

    public function getSeaDateStart(): ?\DateTimeInterface
    {
        return $this->sea_date_start;
    }

    public function setSeaDateStart(\DateTimeInterface $sea_date_start): self
    {
        $this->sea_date_start = $sea_date_start;

        return $this;
    }

    public function getSeaDateEnd(): ?\DateTimeInterface
    {
        return $this->sea_date_end;
    }

    public function setSeaDateEnd(\DateTimeInterface $sea_date_end): self
    {
        $this->sea_date_end = $sea_date_end;

        return $this;
    }

    /**
     * @return Collection|Reservation[]
     */
    public function getSeason(): Collection
    {
        return $this->season;
    }

    public function addSeason(Reservation $season): self
    {
        if (!$this->season->contains($season)) {
            $this->season[] = $season;
            $season->setSeason($this);
        }

        return $this;
    }

    public function removeSeason(Reservation $season): self
    {
        if ($this->season->removeElement($season)) {
            // set the owning side to null (unless already changed)
            if ($season->getSeason() === $this) {
                $season->setSeason(null);
            }
        }

        return $this;
    }

    public function getSeaName(): ?string
    {
        return $this->sea_name;
    }

    public function setSeaName(string $sea_name): self
    {
        $this->sea_name = $sea_name;

        return $this;
    }
}
