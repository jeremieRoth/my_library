<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AuthorRepository")
 */
class Author
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, unique=true)
     */
    private $penName;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPenName(): ?string
    {
        return $this->penName;
    }

    public function setPenName(string $penName): self
    {
        $this->penName = $penName;

        return $this;
    }
}
