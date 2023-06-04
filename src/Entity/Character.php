<?php

namespace App\Entity;

use App\Repository\CharacterRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CharacterRepository::class)]
#[ORM\Table(name: '`character`')]

class Character
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100, nullable: true)]
    private ?string $character_firstname = null;

    #[ORM\Column(length: 100, nullable: true)]
    private ?string $character_lastname = null;

    #[ORM\Column(length: 100)]
    private ?string $character_nickname = null;

    #[ORM\Column(length: 3, nullable: true)]
    private ?string $character_age = null;

    #[ORM\Column(length: 100, nullable: true)]
    private ?string $character_job = null;

    #[ORM\Column(length: 100, nullable: true)]
    private ?string $character_city = null;

    #[ORM\Column(length: 100, nullable: true)]
    private ?string $character_ethnic = null;

    #[ORM\Column(length: 100, nullable: true)]
    private ?string $character_link = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $character_information = null;

    #[ORM\ManyToOne(inversedBy: 'characters')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Category $category_id = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCharacterFirstname(): ?string
    {
        return $this->character_firstname;
    }

    public function setCharacterFirstname(?string $character_firstname): self
    {
        $this->character_firstname = $character_firstname;

        return $this;
    }

    public function getCharacterLastname(): ?string
    {
        return $this->character_lastname;
    }

    public function setCharacterLastname(?string $character_lastname): self
    {
        $this->character_lastname = $character_lastname;

        return $this;
    }

    public function getCharacterNickname(): ?string
    {
        return $this->character_nickname;
    }

    public function setCharacterNickname(string $character_nickname): self
    {
        $this->character_nickname = $character_nickname;

        return $this;
    }

    public function getCharacterAge(): ?string
    {
        return $this->character_age;
    }

    public function setCharacterAge(?string $character_age): self
    {
        $this->character_age = $character_age;

        return $this;
    }

    public function getCharacterJob(): ?string
    {
        return $this->character_job;
    }

    public function setCharacterJob(?string $character_job): self
    {
        $this->character_job = $character_job;

        return $this;
    }

    public function getCharacterCity(): ?string
    {
        return $this->character_city;
    }

    public function setCharacterCity(?string $character_city): self
    {
        $this->character_city = $character_city;

        return $this;
    }

    public function getCharacterEthnic(): ?string
    {
        return $this->character_ethnic;
    }

    public function setCharacterEthnic(?string $character_ethnic): self
    {
        $this->character_ethnic = $character_ethnic;

        return $this;
    }

    public function getCharacterLink(): ?string
    {
        return $this->character_link;
    }

    public function setCharacterLink(?string $character_link): self
    {
        $this->character_link = $character_link;

        return $this;
    }

    public function getCharacterInformation(): ?string
    {
        return $this->character_information;
    }

    public function setCharacterInformation(?string $character_information): self
    {
        $this->character_information = $character_information;

        return $this;
    }

    public function getCategoryId(): ?Category
    {
        return $this->category_id;
    }

    public function setCategoryId(?Category $category_id): self
    {
        $this->category_id = $category_id;

        return $this;
    }
}
