<?php

namespace App\Entity;

use App\Repository\StoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: StoryRepository::class)]
class Story
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $story_name = null;

    #[ORM\ManyToOne(inversedBy: 'stories')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user_id = null;

    #[ORM\OneToMany(mappedBy: 'story_id', targetEntity: Category::class)]
    private Collection $categories;

    #[ORM\OneToMany(mappedBy: 'story_id', targetEntity: Chapter::class, orphanRemoval: true)]
    private Collection $chapters;

    public function __construct()
    {
        $this->categories = new ArrayCollection();
        $this->chapters = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->story_name;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStoryName(): ?string
    {
        return $this->story_name;
    }

    public function setStoryName(string $story_name): self
    {
        $this->story_name = $story_name;

        return $this;
    }

    public function getUserId(): ?User
    {
        return $this->user_id;
    }

    public function setUserId(?User $user_id): self
    {
        $this->user_id = $user_id;

        return $this;
    }

    /**
     * @return Collection<int, Category>
     */
    public function getCategories(): Collection
    {
        return $this->categories;
    }

    public function addCategory(Category $category): self
    {
        if (!$this->categories->contains($category)) {
            $this->categories->add($category);
            $category->setStoryId($this);
        }

        return $this;
    }

    public function removeCategory(Category $category): self
    {
        if ($this->categories->removeElement($category)) {
            // set the owning side to null (unless already changed)
            if ($category->getStoryId() === $this) {
                $category->setStoryId(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Chapter>
     */
    public function getChapters(): Collection
    {
        return $this->chapters;
    }

    public function addChapter(Chapter $chapter): self
    {
        if (!$this->chapters->contains($chapter)) {
            $this->chapters->add($chapter);
            $chapter->setStoryId($this);
        }

        return $this;
    }

    public function removeChapter(Chapter $chapter): self
    {
        if ($this->chapters->removeElement($chapter)) {
            // set the owning side to null (unless already changed)
            if ($chapter->getStoryId() === $this) {
                $chapter->setStoryId(null);
            }
        }

        return $this;
    }
}
