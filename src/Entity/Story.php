<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\StoryRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: StoryRepository::class)]
class Story
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['story'])]
    private ?int $id = null;

    #[Groups(['story'])]
    #[ORM\Column(length: 100)]
    private ?string $name = null;

    #[ORM\ManyToOne(inversedBy: 'stories')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user = null;

    #[ORM\OneToMany(mappedBy: 'story', targetEntity: Category::class, orphanRemoval: true)]
    #[Groups(['story'])]
    private Collection $categories;

    #[ORM\OneToMany(mappedBy: 'story', targetEntity: Chapter::class, orphanRemoval: true)]
    #[Groups(['story'])]
    private Collection $chapters;

    #[ORM\OneToMany(mappedBy: 'story', targetEntity: Character::class, orphanRemoval: true)]
    #[Groups(['story'])]
    private Collection $characters;

    public function __construct()
    {
        $this->categories = new ArrayCollection();
        $this->chapters = new ArrayCollection();
        $this->characters = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->name;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

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
            $category->setStory($this);
        }

        return $this;
    }

    public function removeCategory(Category $category): self
    {
        if ($this->categories->removeElement($category)) {
            // set the owning side to null (unless already changed)
            if ($category->getStory() === $this) {
                $category->setStory(null);
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
            $chapter->setStory($this);
        }

        return $this;
    }

    public function removeChapter(Chapter $chapter): self
    {
        if ($this->chapters->removeElement($chapter)) {
            // set the owning side to null (unless already changed)
            if ($chapter->getStory() === $this) {
                $chapter->setStory(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Character>
     */
    public function getCharacters(): Collection
    {
        return $this->characters;
    }

    public function addCharacter(Character $character): self
    {
        if (!$this->characters->contains($character)) {
            $this->characters->add($character);
            $character->setStory($this);
        }

        return $this;
    }

    public function removeCharacter(Character $character): self
    {
        if ($this->characters->removeElement($character)) {
            // set the owning side to null (unless already changed)
            if ($character->getStory() === $this) {
                $character->setStory(null);
            }
        }

        return $this;
    }
}
