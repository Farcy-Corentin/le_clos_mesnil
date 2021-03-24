<?php

namespace App\Entity;

use App\Repository\CountryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=CountryRepository::class)
 * attributes={
 *     "order"={"name":"DESC"}
 *     },
 *     normalizationContext={"groups"={"read":"countries"}},
 *     collectionOperations={"get","post"},
 *     itemOperations={"get","delete","put","patch"}
 *     )
 */
class Country
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(name="id", type="bigint")
     * @Groups({"read":"categories"})
     */
    private ?int $id;

    /**
     * @ORM\Column(type="string", length=100)
     * @Groups({"read":"categories"})
     */
    private ?string $name;

    /**
     * @ORM\Column(type="string", length=45)
     * @Groups({"read":"categories"})
     */
    private ?string $english_name;

    /**
     * @ORM\OneToMany(targetEntity="User", mappedBy="Country")
     * @return Collection
     * @Groups({"read":"categories"})
     */
    private Collection $users;

    /**
     * Constructeur
     */
    public function __construct()
    {
        $this->users = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(string $id): ?int
    {
        return $this->id = $id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getEnglishName(): ?string
    {
        return $this->english_name;
    }

    public function setEnglishName(string $english_name): self
    {
        $this->english_name = $english_name;

        return $this;
    }

    /**
     * @return Collection
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(User $user): self
    {
        if (!$this->users->contains($user)) {
            $this->users[] = $user;
            $user->setCountry($this);
        }

        return $this;
    }
}
