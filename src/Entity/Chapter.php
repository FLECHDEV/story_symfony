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
    private ?string $ideas = null;

    #[ORM\ManyToOne(inversedBy: 'chapters')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Story $story = null;

    #[ORM\Column(length: 50)]
    private ?string $name = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getChapterIdeas(): ?string
    {
        return $this->ideas;
    }

    public function setChapterIdeas(?string $ideas): self
    {
        $this->ideas = $ideas;

        return $this;
    }

    public function getStory(): ?Story
    {
        return $this->story;
    }

    public function setStory(?Story $story): self
    {
        $this->story = $story;

        return $this;
    }

    public function getChapterName(): ?string
    {
        return $this->name;
    }

    public function setChapterName(string $name): self
    {
        $this->name = $name;

        return $this;
    }
}
