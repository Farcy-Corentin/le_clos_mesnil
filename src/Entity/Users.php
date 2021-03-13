<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\UsersRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=UsersRepository::class)
 * @ApiResource (
 *     attributes={
 *     "order"={"use_last_name":"DESC"}
 *     },
 *     normalizationContext={"groups"={"read":"users"}},
 *     collectionOperations={"get","post"},
 *     itemOperations={"get","delete","put","patch"}
 *     )
 */
#[ApiResource]
class Users
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="bigint")
     * @Groups({"read":"users"})
     */
    private ?int $id;

    /**
     * @ORM\Column(type="string", length=50)
     * @Groups({"read":"users", "read:comment"})
     */
    private ?string $use_last_name;

    /**
     * @ORM\Column(type="string", length=50)
     * @Groups({"read":"users", "read:comment"})
     */
    private ?string $use_first_name;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"read":"users"})
     */
    private ?string $use_mail;

    /**
     * @ORM\Column(type="string", length=10)
     * @Groups({"read":"users"})
     */
    private ?string $use_phone;

    /**
     * @ORM\Column(type="string", length=60)
     * @Groups({"read":"users"})
     */
    private ?string $use_password;

    /**
     * @ORM\Column(type="datetime")
     * @Groups({"read":"users"})
     */
    private ?\DateTimeInterface $use_add_date;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     * @Groups({"read":"users"})
     */
    private ?\DateTimeInterface $use_update_date;

    /**
     * @ORM\ManyToOne(targetEntity=Country::class, inversedBy="users")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"read":"users"})
     */
    private ?country $country;

    /**
     * @ORM\OneToMany(targetEntity=Reservation::class, mappedBy="users")
     * @Groups({"read":"users"})
     */
    private Collection $reservations;

    /**
     * @ORM\OneToMany(targetEntity=CommentPost::class, mappedBy="user")
     * @Groups({"read":"users"})
     */
    private Collection $commentPost;

    /**
     * @ORM\Column(type="string", length=200)
     * @Groups({"read":"users"})
     */
    private ?string $use_url;

    /**
     * @ORM\Column(type="string", length=100)
     * @Groups({"read":"users"})
     */
    private ?string $use_ip;

    private ?string $use_pseudo;

    public function __construct()
    {
        $this->reservations = new ArrayCollection();
        $this->commentPost = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUseLastName(): ?string
    {
        return $this->use_last_name;
    }

    public function setUseLastName(string $use_last_name): self
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
     * @return Collection
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
     * @return Collection
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

    /**
     * @return string|null
     */
    public function getUsePseudo(): ?string
    {
        $use_pseudo=$this->getUseFirstName().$this->getUseLastName();
        return $this->$use_pseudo->use_pseudo;
    }

    /**
     * @param string|null $use_pseudo
     */
    public function setUsePseudo(?string $use_pseudo): void
    {
        $this->use_pseudo = $use_pseudo;
    }
}
