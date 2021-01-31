<?php

namespace App\Entity;

use App\Repository\CommentReservationRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CommentReservationRepository::class)
 */
class CommentReservation
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
    private $com_res_author;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $com_res_email;

    /**
     * @ORM\Column(type="string", length=200)
     */
    private $com_res_author_url;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $com_res_author_ip;

    /**
     * @ORM\Column(type="datetime")
     */
    private $com_res_date;

    /**
     * @ORM\Column(type="datetimetz")
     */
    private $com_res_date_gmt;

    /**
     * @ORM\Column(type="text")
     */
    private $com_res_content;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getComResAuthor(): ?string
    {
        return $this->com_res_author;
    }

    public function setComResAuthor(string $com_res_author): self
    {
        $this->com_res_author = $com_res_author;

        return $this;
    }

    public function getComResEmail(): ?string
    {
        return $this->com_res_email;
    }

    public function setComResEmail(string $com_res_email): self
    {
        $this->com_res_email = $com_res_email;

        return $this;
    }

    public function getComResAuthorUrl(): ?string
    {
        return $this->com_res_author_url;
    }

    public function setComResAuthorUrl(string $com_res_author_url): self
    {
        $this->com_res_author_url = $com_res_author_url;

        return $this;
    }

    public function getComResAuthorIp(): ?string
    {
        return $this->com_res_author_ip;
    }

    public function setComResAuthorIp(string $com_res_author_ip): self
    {
        $this->com_res_author_ip = $com_res_author_ip;

        return $this;
    }

    public function getComResDate(): ?\DateTimeInterface
    {
        return $this->com_res_date;
    }

    public function setComResDate(\DateTimeInterface $com_res_date): self
    {
        $this->com_res_date = $com_res_date;

        return $this;
    }

    public function getComResDateGmt(): ?\DateTimeInterface
    {
        return $this->com_res_date_gmt;
    }

    public function setComResDateGmt(\DateTimeInterface $com_res_date_gmt): self
    {
        $this->com_res_date_gmt = $com_res_date_gmt;

        return $this;
    }

    public function getComResContent(): ?string
    {
        return $this->com_res_content;
    }

    public function setComResContent(string $com_res_content): self
    {
        $this->com_res_content = $com_res_content;

        return $this;
    }
}
