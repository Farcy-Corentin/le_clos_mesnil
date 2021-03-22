<?php

namespace App\Entity;

use App\Repository\ReservationRepository;
use Doctrine\ORM\Mapping as ORM;
use phpDocumentor\Reflection\Types\Integer;

/**
 * @ORM\Entity(repositoryClass=ReservationRepository::class)
 */
class Reservation
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="bigint")
     */
    private ?int $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private ?\DateTimeInterface $date;

    /**
     * @ORM\Column(type="date")
     */
    private ?\DateTimeInterface $date_start;

    /**
     * @ORM\Column(type="date")
     */
    private ?\DateTimeInterface $date_end;

    /**
     * @ORM\Column(type="integer")
     */
    private ?int $price;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private ?\DateTimeInterface $payment_date;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="reservations")
     * @ORM\JoinColumn(nullable=false)
     */
    private ?User $users;

    /**
     * @ORM\ManyToOne(targetEntity=Season::class, inversedBy="season")
     * @ORM\JoinColumn(nullable=true)
     */
    private ?season $season;

    /**
     * @ORM\OneToOne(targetEntity=CommentReservation::class, mappedBy="reservation", cascade={"persist", "remove"})
     */
    private ?Commentreservation $commentReservation;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getResDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setResDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getResDateStart(): ?\DateTimeInterface
    {
        return $this->date_start;
    }

    public function setResDateStart(\DateTimeInterface $date_start): self
    {
        $this->date_start = $date_start;

        return $this;
    }

    public function getResDateEnd(): ?\DateTimeInterface
    {
        return $this->date_end;
    }

    public function setResDateEnd(\DateTimeInterface $date_end): self
    {
        $this->date_end = $date_end;

        return $this;
    }

    public function getResPrice(): ?int
    {
        return $this->price;
    }

    public function setResPrice(int $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getResPaymentDate(): ?\DateTimeInterface
    {
        return $this->payment_date;
    }

    public function setResPaymentDate(?\DateTimeInterface $payment_date): self
    {
        $this->payment_date = $payment_date;

        return $this;
    }

    public function getUsers(): ?User
    {
        return $this->users;
    }

    public function setUsers(?User $users): self
    {
        $this->users = $users;

        return $this;
    }

    public function getSeason(): ?season
    {
        return $this->season;
    }

    public function setSeason(?season $season): self
    {
        $this->season = $season;

        return $this;
    }

    public function getCommentReservation(): ?Commentreservation
    {
        return $this->commentReservation;
    }

    public function setCommentReservation(Commentreservation $commentReservation): self
    {
        // set the owning side of the relation if necessary
        if ($commentReservation->getReservation() !== $this) {
            $commentReservation->setReservation($this);
        }

        $this->commentReservation = $commentReservation;

        return $this;
    }
}
