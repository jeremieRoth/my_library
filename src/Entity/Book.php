<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\BookRepository")
 */
class Book
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $author;

    /**
     * @ORM\ManyToOne(targetEntity=Series::class)
     */
    private $series;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $releaseDate;

    /**
     * @ORM\Column(type="boolean")
     */
    private $releaseStatus;

    /**
     * @ORM\Column(type="boolean")
     */
    private $status;

    /**
     * hors serie
     * @ORM\Column(type="boolean")
     */
    private $special;

    /**
     * isbn code
     * @ORM\Column(type="string", length=13)
     */
    private $isbn;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * @param mixed $author
     * @return Book
     */
    public function setAuthor($author)
    {
        $this->author = $author;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getSeries()
    {
        return $this->series;
    }

    /**
     * @param mixed $series
     */
    public function setSeries($series): void
    {
        $this->series = $series;
    }

    public function getReleaseDate(): ?\DateTimeInterface
    {
        return $this->releaseDate;
    }

    public function setReleaseDate(?\DateTimeInterface $releaseDate): self
    {
        $this->releaseDate = $releaseDate;

        return $this;
    }

    public function getReleaseStatus(): ?bool
    {
        return $this->releaseStatus;
    }

    public function setReleaseStatus(bool $releaseStatus): self
    {
        $this->releaseStatus = $releaseStatus;

        return $this;
    }

    public function getStatus(): ?bool
    {
        return $this->status;
    }

    public function setStatus(bool $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getSpecial(): ?bool
    {
        return $this->special;
    }

    public function setSpecial(bool $special): self
    {
        $this->special = $special;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getIsbn()
    {
        return $this->isbn;
    }

    /**
     * @param mixed $isbn
     * @return Book
     */
    public function setIsbn($isbn)
    {
        $this->isbn = $isbn;
        return $this;
    }
}
