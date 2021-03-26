<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 * @ApiResource (
 *     attributes={
 *     "order"={"use_last_name":"DESC"}
 *     },
 *     normalizationContext={"groups"={"read":"users"}},
 *     collectionOperations={"get","post"},
 *     itemOperations={"get","delete","put","patch"}
 *     )
 * @UniqueEntity(fields={"email"}, message="There is already an account with this email")
 */
#[ApiResource]
class User implements UserInterface
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
    private ?string $lastName;

    /**
     * @ORM\Column(type="string", length=50)
     * @Groups({"read:comment"})
     */
    private ?string $firstName;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     */
    private ?string $email;

    /**
     * @ORM\Column(type="string", length=20)
     * @Groups({"read":"users"})
     */
    private ?string $phone;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"read":"users"})
     */
    private ?string $password;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     * @Groups({"read":"users"})
     */
    private ?\DateTimeInterface $createAt;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     * @Groups({"read":"users"})
     */
    private ?\DateTimeInterface $updateDate;

    /**
     * @ORM\ManyToOne(targetEntity="Country", inversedBy="user")
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
     * @ORM\Column(type="string", length=200, nullable=true)
     * @Groups({"read":"users"})
     */
    private ?string $url;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     * @Groups({"read":"users"})
     */
    private ?string $ip;

    private ?string $pseudo;

    /**
     * @ORM\Column(type="json")
     */
    private array $roles = [];

    /**
     * @ORM\Column(type="boolean")
     */
    private $isVerified = false;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $activation_token;

    public function __construct()
    {
        $this->reservations = new ArrayCollection();
        $this->commentPost = new ArrayCollection();
        // $this->email = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): self
    {
        $this->phone = $phone;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getCreateAt(): ?\DateTimeInterface
    {
        return $this->createAt;
    }

    public function setCreateAt(\DateTimeInterface $createAt): self
    {

        $this->createAt = $createAt;

        return $this;
    }

    public function getUpdateDate(): ?\DateTimeInterface
    {
        return $this->updateDate;
    }

    public function setUpdateDate(?\DateTimeInterface $updateDate): self
    {
        $this->updateDate = $updateDate;

        return $this;
    }

    public function getCountry(): ?Country
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

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function setUrl(string $url): self
    {
        $this->url = $url;

        return $this;
    }

    public function getIp(): ?string
    {
        return $this->ip;
    }

    public function setIp(string $ip): self
    {
        $this->ip = $ip;

        return $this;
    }

    public function getPseudo(): ?string
    {
        return $this->pseudo;
    }
    public function setPseudo()
    {
        $this->pseudo = $this->firstName . " " . $this->lastName;
        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = array(
            'ROLE_USER',
            'ROLE_ADMIN'
        );

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getSalt()
    {
        // not needed when using the "bcrypt" algorithm in security.yaml
    }


    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function isVerified(): bool
    {
        return $this->isVerified;
    }

    public function setIsVerified(bool $isVerified): self
    {
        $this->isVerified = $isVerified;

        return $this;
    }

    public function getActivationToken(): ?string
    {
        return $this->activation_token;
    }

    public function setActivationToken(?string $activation_token): self
    {
        $this->activation_token = $activation_token;

        return $this;
    }
}
