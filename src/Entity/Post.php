<?php

namespace App\Entity;

use App\Repository\PostRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PostRepository::class)
 */
class Post
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="bigint")
     */
    private ?int $id;

    /**
     * @ORM\Column(type="text")
     */
    private ?string $post_content;

    /**
     * @ORM\Column(type="text")
     */
    private ?string $post_title;

    /**
     * @ORM\Column(type="string", length=20)
     */
    private ?string $post_status;

    /**
     * @ORM\Column(type="string", length=20)
     */
    private ?string $post_comment_status;

    /**
     * @ORM\Column(type="string", length=200)
     */
    private ?string $post_name;

    /**
     * @ORM\Column(type="bigint")
     */
    private ?string $post_comment_count;

    /**
     * @ORM\ManyToOne(targetEntity=Category::class, inversedBy="posts")
     * @ORM\JoinColumn(nullable=false)
     */
    private ?category $category;

    /**
     * @ORM\OneToMany(targetEntity=CommentPost::class, mappedBy="post")
     */
    private ArrayCollection $commentPost;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private ?\DateTimeInterface $post_update_date;

    public function __construct()
    {
        $this->commentPost = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setPostDate(\DateTimeInterface $post_date): self
    {
        $this->$post_date = $post_date;

        return $this;
    }

    public function getPostContent(): ?string
    {
        return $this->post_content;
    }

    public function setPostContent(string $post_content): self
    {
        $this->post_content = $post_content;

        return $this;
    }

    public function getPostTitle(): ?string
    {
        return $this->post_title;
    }

    public function setPostTitle(string $post_title): self
    {
        $this->post_title = $post_title;

        return $this;
    }

    public function getPostStatus(): ?string
    {
        return $this->post_status;
    }

    public function setPostStatus(string $post_status): self
    {
        $this->post_status = $post_status;

        return $this;
    }

    public function getPostCommentStatus(): ?string
    {
        return $this->post_comment_status;
    }

    public function setPostCommentStatus(string $post_comment_status): self
    {
        $this->post_comment_status = $post_comment_status;

        return $this;
    }

    public function getPostName(): ?string
    {
        return $this->post_name;
    }

    public function setPostName(string $post_name): self
    {
        $this->post_name = $post_name;

        return $this;
    }

    public function getPostCommentCount(): ?string
    {
        return $this->post_comment_count;
    }

    public function setPostCommentCount(string $post_comment_count): self
    {
        $this->post_comment_count = $post_comment_count;

        return $this;
    }

    public function getCategory(): ?category
    {
        return $this->category;
    }

    public function setCategory(?category $category): self
    {
        $this->category = $category;

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
            $commentPost->setPost($this);
        }

        return $this;
    }

    public function removeCommentPost(CommentPost $commentPost): self
    {
        if ($this->commentPost->removeElement($commentPost)) {
            // set the owning side to null (unless already changed)
            if ($commentPost->getPost() === $this) {
                $commentPost->setPost(null);
            }
        }

        return $this;
    }

    public function getPostUpdateDate(): ?\DateTimeInterface
    {
        return $this->post_update_date;
    }

    public function setPostUpdateDate(?\DateTimeInterface $post_update_date): self
    {
        $this->post_update_date = $post_update_date;

        return $this;
    }
}
