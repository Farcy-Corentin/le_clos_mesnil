<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\CategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=CategoryRepository::class)
 * @ApiResource (
 *     attributes={
 *     "order"={"cat_name":"DESC"}
 *     },
 *     normalizationContext={"groups"={"read":"categories"}},
 *     collectionOperations={"get","post"},
 *     itemOperations={"get","delete","put","patch"}
 *     )
 */
class Category
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"read":"categories"})
     */
    private ?int $id;

    /**
     * @ORM\Column(type="string", length=50)
     * @Groups({"read":"categories"})
     */
    private ?string $cat_name;

    /**
     * @ORM\OneToMany(targetEntity=Post::class, mappedBy="category")
     * @Groups({"read":"categories"})
     */
    private Collection $posts;

    /**
     * @ORM\ManyToOne(targetEntity=Category::class, inversedBy="category")
     * @Groups({"read":"categories"})
     */
    private ?Category $cat_parent;

    public function __construct()
    {
        $this->posts = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCatName(): ?string
    {
        return $this->cat_name;
    }

    public function setCatName(string $cat_name): self
    {
        $this->cat_name = $cat_name;

        return $this;
    }

    /**
     * @return Collection
     */
    public function getPosts(): Collection
    {
        return $this->posts;
    }

    public function addPost(Post $post): self
    {
        if (!$this->posts->contains($post)) {
            $this->posts[] = $post;
            $post->setCategory($this);
        }

        return $this;
    }

    public function removePost(Post $post): self
    {
        if ($this->posts->removeElement($post)) {
            // set the owning side to null (unless already changed)
            if ($post->getCategory() === $this) {
                $post->setCategory(null);
            }
        }

        return $this;
    }

    public function getCatParentId(): ?self
    {
        return $this->cat_parent;
    }

    public function setCatParentId(?self $cat_parent): self
    {
        $this->cat_parent = $cat_parent;

        return $this;
    }
}
