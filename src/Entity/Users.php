<?php

namespace App\Entity;

use App\Repository\UsersRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=UsersRepository::class)
 */
class Users
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="bigint")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $use_last_name;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $use_first_name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $use_mail;

    /**
     * @ORM\Column(type="string", length=10)
     */
    private $use_phone;

    /**
     * @ORM\Column(type="string", length=60)
     */
    private $use_password;

    /**
     * @ORM\Column(type="datetime")
     */
    private $use_add_date;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $use_update_date;

    /**
     * @ORM\ManyToOne(targetEntity=country::class, inversedBy="users")
     * @ORM\JoinColumn(nullable=false)
     */
    private $country;

    /**
     * @ORM\OneToMany(targetEntity=Reservation::class, mappedBy="users")
     */
    private $reservations;

    /**
     * @ORM\OneToMany(targetEntity=CommentPost::class, mappedBy="user")
     */
    private $commentPost;

    /**
     * @ORM\Column(type="string", length=200)
     */
    private $use_url;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $use_ip;

    public function __construct()
    {
        $this->reservations = new ArrayCollection();
        $this->commentPost = new ArrayCollection();
    }


    public function getUseId(): ?string
    {
        return $this->id;
    }

    public function getUneLastName(): ?string
    {
        return $this->use_last_name;
    }

    public function setUneLastName(string $use_last_name): self
    {
        $this->use_last_name = $use_last_name;

        return $this;
    }

    public function getUseFirstName(): ?string
    {
        return $this->use_first_name;
    }

    public function setUseFirstName(string $use_first_name): self
    {
        $this->use_first_name = $use_first_name;

        return $this;
    }

    public function getUseMail(): ?string
    {
        return $this->use_mail;
    }

    public function setUseMail(string $use_mail): self
    {
        $this->use_mail = $use_mail;

        return $this;
    }

    public function getUsePhone(): ?string
    {
        return $this->use_phone;
    }

    public function setUsePhone(string $use_phone): self
    {
        $this->use_phone = $use_phone;

        return $this;
    }

    public function getUsePassword(): ?string
    {
        return $this->use_password;
    }

    public function setUsePassword(string $use_password): self
    {
        $this->use_password = $use_password;

        return $this;
    }

    public function getUseAddDate(): ?\DateTimeInterface
    {
        return $this->use_add_date;
    }

    public function setUseAddDate(\DateTimeInterface $use_add_date): self
    {
        $this->use_add_date = $use_add_date;

        return $this;
    }

    public function getUseUpdateDate(): ?\DateTimeInterface
    {
        return $this->use_update_date;
    }

    public function setUseUpdateDate(?\DateTimeInterface $use_update_date): self
    {
        $this->use_update_date = $use_update_date;

        return $this;
    }

    public function getCountry(): ?country
    {
        return $this->country;
    }

    public function setCountry(?country $country): self
    {
        $this->country = $country;

        return $this;
    }

    /**
     * @return Collection|Reservation[]
     */
    public function getReservations(): Collection
    {
        return $this->reservations;
    }

    public function addReservation(Reservation $reservation): self
    {
        if (!$this->reservations->contains($reservation)) {
            $this->reservations[] = $reservation;
            $reservation->setUsers($this);
        }

        return $this;
    }

    public function removeReservation(Reservation $reservation): self
    {
        if ($this->reservations->removeElement($reservation)) {
            // set the owning side to null (unless already changed)
            if ($reservation->getUsers() === $this) {
                $reservation->setUsers(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|CommentPost[]
     */
    public function getCommentPost(): Collection
    {
        return $this->commentPost;
    }

    public function addCommentPost(CommentPost $commentPost): self
    {
        if (!$this->commentPost->contains($commentPost)) {
            $this->commentPost[] = $commentPost;
            $commentPost->setUser($this);
        }

        return $this;
    }

    public function removeCommentPost(CommentPost $commentPost): self
    {
        if ($this->commentPost->removeElement($commentPost)) {
            // set the owning side to null (unless already changed)
            if ($commentPost->getUser() === $this) {
                $commentPost->setUser(null);
            }
        }

        return $this;
    }

    public function getUseUrl(): ?string
    {
        return $this->use_url;
    }

    public function setUseUrl(string $use_url): self
    {
        $this->use_url = $use_url;

        return $this;
    }

    public function getUseIp(): ?string
    {
        return $this->use_ip;
    }

    public function setUseIp(string $use_ip): self
    {
        $this->use_ip = $use_ip;

        return $this;
    }
}
