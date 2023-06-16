<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\ChapterRepository;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Serializer\Annotation\Ignore;

#[ORM\Entity(repositoryClass: ChapterRepository::class)]
class Chapter
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['story'])]
    private ?int $id = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    #[Groups(['story'])]
    private ?string $ideas = null;

    #[ORM\ManyToOne(inversedBy: 'chapters')]
    #[ORM\JoinColumn(nullable: false)]
    #[Ignore]
    private ?Story $story = null;

    #[ORM\Column(length: 50)]
    #[Groups(['story'])]
    private ?string $name = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdeas(): ?string
    {
        return $this->ideas;
    }

    public function setIdeas(?string $ideas): self
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

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }
}
