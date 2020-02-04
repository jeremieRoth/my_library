<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\Book;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserBookCollectionRepository")
 */
class UserBookCollection
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="User")
     */
    private $user;

    /**
     * @ORM\Column(type="string", length=180)
     */
    private $name;

    /**
     * @ORM\ManyToMany(targetEntity="Book")
     */
    // TODO cascade
    private $bookList;

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getBookList()
    {
        return $this->bookList;
    }

    /**
     * @param mixed $bookList
     * @return UserBookCollection
     */
    public function setBookList($bookList)
    {
        $this->bookList = $bookList;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param mixed $user
     * @return UserBookCollection
     */
    public function setUser($user)
    {
        $this->user = $user;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     * @return UserBookCollection
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

}
