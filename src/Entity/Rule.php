<?php

namespace App\Entity;

use App\Repository\RuleRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=RuleRepository::class)
 */
class Rule
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
    private $rul_title;

    /**
     * @ORM\Column(type="text")
     */
    private $rul_description;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $rul_english_title;

    /**
     * @ORM\Column(type="text")
     */
    private $rul_english_description;

    /**
     * @ORM\ManyToOne(targetEntity=gite::class, inversedBy="rule")
     * @ORM\JoinColumn(nullable=false)
     */
    private $gite;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRulTitle(): ?string
    {
        return $this->rul_title;
    }

    public function setRulTitle(string $rul_title): self
    {
        $this->rul_title = $rul_title;

        return $this;
    }

    public function getRulDescription(): ?string
    {
        return $this->rul_description;
    }

    public function setRulDescription(string $rul_description): self
    {
        $this->rul_description = $rul_description;

        return $this;
    }

    public function getRulEnglishTitle(): ?string
    {
        return $this->rul_english_title;
    }

    public function setRulEnglishTitle(string $rul_english_title): self
    {
        $this->rul_english_title = $rul_english_title;

        return $this;
    }

    public function getRulEnglishDescription(): ?string
    {
        return $this->rul_english_description;
    }

    public function setRulEnglishDescription(string $rul_english_description): self
    {
        $this->rul_english_description = $rul_english_description;

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
