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
    private ?Integer $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private ?\DateTimeInterface $res_date;

    /**
     * @ORM\Column(type="date")
     */
    private ?\DateTimeInterface $res_date_start;

    /**
     * @ORM\Column(type="date")
     */
    private ?\DateTimeInterface $res_date_end;

    /**
     * @ORM\Column(type="integer")
     */
    private ?int $res_price;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private ?\DateTimeInterface $res_payment_date;

    /**
     * @ORM\ManyToOne(targetEntity=Users::class, inversedBy="reservations")
     * @ORM\JoinColumn(nullable=false)
     */
    private ?users $users;

    /**
     * @ORM\ManyToOne(targetEntity=Season::class, inversedBy="season")
     * @ORM\JoinColumn(nullable=true)
     */
    private ?season $season;

    /**
     * @ORM\OneToOne(targetEntity=Commentreservation::class, mappedBy="reservation", cascade={"persist", "remove"})
     */
    private ?Commentreservation $commentReservation;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getResDate(): ?\DateTimeInterface
    {
        return $this->res_date;
    }

    public function setResDate(\DateTimeInterface $res_date): self
    {
        $this->res_date = $res_date;

        return $this;
    }

    public function getResDateStart(): ?\DateTimeInterface
    {
        return $this->res_date_start;
    }

    public function setResDateStart(\DateTimeInterface $res_date_start): self
    {
        $this->res_date_start = $res_date_start;

        return $this;
    }

    public function getResDateEnd(): ?\DateTimeInterface
    {
        return $this->res_date_end;
    }

    public function setResDateEnd(\DateTimeInterface $res_date_end): self
    {
        $this->res_date_end = $res_date_end;

        return $this;
    }

    public function getResPrice(): ?int
    {
        return $this->res_price;
    }

    public function setResPrice(int $res_price): self
    {
        $this->res_price = $res_price;

        return $this;
    }

    public function getResPaymentDate(): ?\DateTimeInterface
    {
        return $this->res_payment_date;
    }

    public function setResPaymentDate(?\DateTimeInterface $res_payment_date): self
    {
        $this->res_payment_date = $res_payment_date;

        return $this;
    }

    public function getUsers(): ?users
    {
        return $this->users;
    }

    public function setUsers(?users $users): self
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
