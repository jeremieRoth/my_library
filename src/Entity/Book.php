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
     * @ORM\Column(type="integer", nullable=true)
     */
    private $number;

    /**
     * @ORM\ManyToOne(targetEntity=Author::class, cascade={"persist"})
     */
    private $author;

    /**
     * @ORM\ManyToOne(targetEntity=Series::class, cascade={"persist"})
     */
    private $series;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $summary;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $releaseDate;

    /**
     * @ORM\Column(type="datetime")
     */
    private $creationDate;

    /**
     * @ORM\Column(type="datetime")
     */
    private $updateDate;

    /**
     * @ORM\Column(type="boolean")
     */
    private $validate;

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
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * @param mixed $number
     * @return Book
     */
    public function setNumber($number)
    {
        $this->number = $number;
        return $this;
    }

    /**
     * @return Author
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * @param Author $author
     * @return Book
     */
    public function setAuthor(Author $author): Book
    {
        $this->author = $author;
        return $this;
    }

    /**
     * @return Series
     */
    public function getSeries()
    {
        return $this->series;
    }

    /**
     * @param Series $series
     * @return Book
     */
    public function setSeries(Series $series): Book
    {
        $this->series = $series;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getSummary()
    {
        return $this->summary;
    }

    /**
     * @param mixed $summary
     * @return Book
     */
    public function setSummary($summary)
    {
        $this->summary = $summary;
        return $this;
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

    public function getCreationDate(): ?\DateTimeInterface
    {
        return $this->creationDate;
    }

    public function setCreationDate(?\DateTimeInterface $creationDate): self
    {
        $this->creationDate = $creationDate;

        return $this;
    }

    public function getUpdateDate(): ?\DateTimeInterface
    {
        return $this->updateDate;
    }

    public function setUpdateDate(?\DateTimeInterface $updateDate): self
    {
        $this->updateDate = $updateDate;

        return $this;
    }

    public function getValidate(): ?bool
    {
        return $this->validate;
    }

    public function setValidate(bool $validate): self
    {
        $this->validate = $validate;

        return $this;
    }
}
