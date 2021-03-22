<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\CommentPostRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=CommentPostRepository::class)
 * @ApiResource(
 *     attributes={
         "order"={"com_post_date":"DESC"}
 *     },
 *     paginationItemsPerPage=2,
 *     normalizationContext={"groups"={"create:comment", "read:comment", "update:comment", "delete:comment"}},
 *     collectionOperations={
 *          "get",
 *          "post"={
 *              "security"="is_granted('IS_AUTHENTICATED_FULLY')",
 *              "controller"="App\Controller\Api\CommentCreateController::class",
 *              "denormalization_context"={"groups"={"create:comment"}}
 *              }
 *      },
 *     itemOperations={
 *       "get"={
 *          "normalization_context"={
 *              "groups"={
 *                  "read:comment",
 *                  "read:full:comment"
 *              }
 *          }
 *        }
 *     ,"delete"={
 *     "security"="is_granted('EDIT_COMMENT', object)",
 *      },
 *     "put"={
 *     "security"="is_granted('EDIT_COMMENT', object)",
 *     "denormalization_context"={"groups"={"update:comment"}}
 *      }
 *      }
 * )
 * @ApiFilter(SearchFilter::class,properties={"post": "exact"})
 */

class CommentPost
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"read:comment", "delete:comment"})
     */
    private ?int $id;

    /**
     * @ORM\Column(type="datetime")
     * @Groups({"read:comment"}, )
     */
    private ?\DateTimeInterface $com_post_date;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     * @Groups({"read:comment"})
     */
    private ?\DateTimeInterface $com_update_date;

    /**
     * @ORM\Column(type="text")
     * @Groups({"read:comment", "create:comment", "update:comment"})
     */
    private ?string $com_post_content;

    /**
     * @ORM\ManyToOne(targetEntity=Post::class, inversedBy="commentPost")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"read:full:comment", "create:comment"})
     */
    private ?post $post;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="commentPost")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"read:comment"})
     */
    private ?User $user;

    private ?string $author;

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

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
       $this->user = $user;

       return $this;
    }

    /**
     * @return string|null
     */
    public function getAuthor(): ?string
    {
        $users = $this->getUser();
        $this->author = $users;
        return $this;
    }

    /**
     * @param string|null $author
     */
    public function setAuthor(?string $author): void
    {
        $this->author = $author;
    }
}
