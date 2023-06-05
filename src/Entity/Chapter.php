<?php

namespace App\Entity;

use App\Repository\ChapterRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ChapterRepository::class)]
class Chapter
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $chapter_ideas = null;

    #[ORM\ManyToOne(inversedBy: 'chapters')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Story $story_id = null;

    #[ORM\Column(length: 50)]
    private ?string $chapter_name = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getChapterIdeas(): ?string
    {
        return $this->chapter_ideas;
    }

    public function setChapterIdeas(?string $chapter_ideas): self
    {
        $this->chapter_ideas = $chapter_ideas;

        return $this;
    }

    public function getStoryId(): ?Story
    {
        return $this->story_id;
    }

    public function setStoryId(?Story $story_id): self
    {
        $this->story_id = $story_id;

        return $this;
    }

    public function getChapterName(): ?string
    {
        return $this->chapter_name;
    }

    public function setChapterName(string $chapter_name): self
    {
        $this->chapter_name = $chapter_name;

        return $this;
    }
}
