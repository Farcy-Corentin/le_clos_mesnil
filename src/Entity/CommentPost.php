<?php

namespace App\Entity;

use App\Repository\CommentPostRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CommentPostRepository::class)
 */
class CommentPost
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
    private ?\DateTimeInterface $com_post_date;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private ?\DateTimeInterface $com_update_date;

    /**
     * @ORM\Column(type="text")
     */
    private ?string $com_post_content;

    /**
     * @ORM\ManyToOne(targetEntity=Post::class, inversedBy="commentPost")
     * @ORM\JoinColumn(nullable=false)
     */
    private ?post $post;

    /**
     * @ORM\ManyToOne(targetEntity=Users::class, inversedBy="commentPost")
     * @ORM\JoinColumn(nullable=false)
     */
    private ?users $user;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getComPostDate(): ?\DateTimeInterface
    {
        return $this->com_post_date;
    }

    public function setComPostDate(\DateTimeInterface $com_post_date): self
    {
        $this->com_post_date = $com_post_date;

        return $this;
    }

    public function getComUpdateDate(): ?\DateTimeInterface
    {
        return $this->com_update_date;
    }

    public function setComUpdateDate(?\DateTimeInterface $com_update_date): self
    {
        $this->com_update_date = $com_update_date;

        return $this;
    }

    public function getComPostContent(): ?string
    {
        return $this->com_post_content;
    }

    public function setComPostContent(string $com_post_content): self
    {
        $this->com_post_content = $com_post_content;

        return $this;
    }

    public function getPost(): ?post
    {
        return $this->post;
    }

    public function setPost(?post $post): self
    {
        $this->post = $post;

        return $this;
    }

    public function getUser(): ?users
    {
        return $this->user;
    }

    public function setUser(?users $user): self
    {
        $this->user = $user;

        return $this;
    }
}
