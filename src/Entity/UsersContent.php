<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UsersContentRepository")
 */
class UsersContent
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $header_text;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $header_image;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $section1;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $section2;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $section3;

    /**
     * @ORM\Column(type="integer")
     */
    private $user_id;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getHeaderText(): ?string
    {
        return $this->header_text;
    }

    public function setHeaderText(?string $header_text): self
    {
        $this->header_text = $header_text;

        return $this;
    }

    public function getHeaderImage(): ?string
    {
        return $this->header_image;
    }

    public function setHeaderImage(?string $header_image): self
    {
        $this->header_image = $header_image;

        return $this;
    }

    public function getSection1(): ?string
    {
        return $this->section1;
    }

    public function setSection1(?string $section1): self
    {
        $this->section1 = $section1;

        return $this;
    }

    public function getSection2(): ?string
    {
        return $this->section2;
    }

    public function setSection2(?string $section2): self
    {
        $this->section2 = $section2;

        return $this;
    }

    public function getSection3(): ?string
    {
        return $this->section3;
    }

    public function setSection3(?string $section3): self
    {
        $this->section3 = $section3;

        return $this;
    }

    public function getUserId(): ?int
    {
        return $this->user_id;
    }

    public function setUserId(int $user_id): self
    {
        $this->user_id = $user_id;

        return $this;
    }
}
