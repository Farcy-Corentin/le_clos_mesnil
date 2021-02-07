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
    private ?int $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private ?\DateTimeInterface $com_res_date;

    /**
     * @ORM\Column(type="text")
     */
    private ?string $com_res_content;

    /**
     * @ORM\OneToOne(targetEntity=Reservation::class, inversedBy="commentReservation")
     * @ORM\JoinColumn(nullable=false)
     */
    private ?reservation $reservation;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getComResContent(): ?string
    {
        return $this->com_res_content;
    }

    public function setComResContent(string $com_res_content): self
    {
        $this->com_res_content = $com_res_content;

        return $this;
    }

    public function getReservation(): ?reservation
    {
        return $this->reservation;
    }

    public function setReservation(reservation $reservation): self
    {
        $this->reservation = $reservation;

        return $this;
    }
}
