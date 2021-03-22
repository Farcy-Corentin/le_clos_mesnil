<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\PostRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;


/**
 * @ORM\Entity(repositoryClass=PostRepository::class)
 * @ApiResource(
 *     attributes={
            "order"={"date":"DESC"},
 *     },
 *     paginationItemsPerPage=5,
 *     normalizationContext={"groups"={"read:post", "update:post", "delete:post"}},
 *     collectionOperations={"get","post"},
 *     itemOperations={
 *       "get"={
 *          "controller"="App\Controller\Api\EmptyController::class",
 *          "read"=false,
 *          "deserialize"=false,
 *       "delete","put","patch"}}
 *     )
 */
class Post
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="bigint")
     * @Groups({"read:post", "delete:post"})
     */
    private ?int $id;

    /**
     * @ORM\Column(type="text")
     * @Groups({"read:post", "update:post"})
     */
    private ?string $content;

    /**
     * @ORM\Column(type="text")
     * @Groups({"read:post", "update:post", "read:comment"})
     */
    private ?string $title;

    /**
     * @ORM\Column(type="string", length=20)
     * @Groups({"read:post", "update:post"})
     */
    private ?string $status;

    /**
     * @ORM\Column(type="string", length=20)
     * @Groups({"read:post", "update:post"})
     */
    private ?string $comment_status;

    /**
     * @ORM\Column(type="string", length=200)
     * @Groups({"read:post", "update:post"})
     */
    private ?string $name;

    /**
     * @ORM\Column(type="bigint")
     * @Groups({"read:post"})
     */
    private ?string $comment_count;

    /**
     * @ORM\ManyToOne(targetEntity=Category::class, inversedBy="posts")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"read:post", "update:post"})
     */
    private ?category $category;

    /**
     * @ORM\OneToMany(targetEntity=CommentPost::class, mappedBy="post")
     * @Groups({"read:post"})
     * @return Collection
     */
    private Collection $commentPost;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     * @Groups({"read:post", "update:post"})
     */
    private ?\DateTimeInterface $update_date;

    /**
     * @ORM\Column(type="datetime")
     * @Groups({"read:post", "update:post"})
     */
    private ?\DateTimeInterface $date;

    public function __construct()
    {
        $this->commentPost = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setPostDate(\DateTimeInterface $date): self
    {
        $this->$date = $date;

        return $this;
    }

    public function getPostContent(): ?string
    {
        return $this->content;
    }

    public function setPostContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function getPostTitle(): ?string
    {
        return $this->title;
    }

    public function setPostTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getPostStatus(): ?string
    {
        return $this->status;
    }

    public function setPostStatus(string $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getPostCommentStatus(): ?string
    {
        return $this->comment_status;
    }

    public function setPostCommentStatus(string $comment_status): self
    {
        $this->comment_status = $comment_status;

        return $this;
    }

    public function getPostName(): ?string
    {
        return $this->name;
    }

    public function setPostName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getPostCommentCount(): ?string
    {
        return $this->comment_count;
    }

    public function setPostCommentCount(string $comment_count): self
    {
        $this->comment_count = $comment_count;

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
        return $this->update_date;
    }

    public function setPostUpdateDate(?\DateTimeInterface $update_date): self
    {
        $this->update_date = $update_date;

        return $this;
    }

    public function getPostDate(): ?\DateTimeInterface
    {
        return $this->date;
    }
}
