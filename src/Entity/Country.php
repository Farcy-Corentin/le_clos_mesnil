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
 *     "order"={"cou_name":"DESC"}
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
     * @ORM\Column(type="string", length=2)
     * @Groups({"read":"categories"})
     */
    private ?string $id;

    /**
     * @ORM\Column(type="string", length=45)
     * @Groups({"read":"categories"})
     */
    private ?string $cou_name;

    /**
     * @ORM\Column(type="string", length=45)
     * @Groups({"read":"categories"})
     */
    private ?string $cou_english_name;

    /**
     * @ORM\OneToMany(targetEntity=Users::class, mappedBy="country")
     * @return Collection
     * @Groups({"read":"categories"})
     */
    private Collection $users;

    public function __construct()
    {
        $this->users = new ArrayCollection();
    }

    public function getId(): ?string
    {
        return $this->id;
    }

    public function setId(string $id): ?string
    {
        return $this->id = $id;
    }

    public function getCouName(): ?string
    {
        return $this->cou_name;
    }

    public function setCouName(string $cou_name): self
    {
        $this->cou_name = $cou_name;

        return $this;
    }

    public function getCouEnglishName(): ?string
    {
        return $this->cou_english_name;
    }

    public function setCouEnglishName(string $cou_english_name): self
    {
        $this->cou_english_name = $cou_english_name;

        return $this;
    }

    /**
     * @return Collection
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(Users $user): self
    {
        if (!$this->users->contains($user)) {
            $this->users[] = $user;
            $user->setCountry($this);
        }

        return $this;
    }
}


