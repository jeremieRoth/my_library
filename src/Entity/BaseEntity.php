<?php

namespace App\Entity;

use DateTime;
use Doctrine\ORM\Mapping as ORM;

abstract class BaseEntity
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="UUID")
     * @ORM\Column(type="guid")
     */
    protected $id;

    /**
     * @var Datetime $created
     *
     * @ORM\Column(type="datetime")
     */
    protected $created_at;

    /**
     * @var Datetime $updated
     * 
     * @ORM\Column(type="datetime", nullable = true)
     */
    protected $updated_at;

    /**
     * @var Datetime $updated
     * 
     * @ORM\Column(type="datetime", nullable = true)
     */
    protected $deleted_at;

    public function getId(): ?string
    {
        return $this->id;
    }

    /**
     * Gets triggered only on insert
     * 
     * @ORM\PrePersist
     */
    public function onPrePersist()
    {
        $this->created_at = new DateTime("now");
        return $this->onPreUpdate();
    }

    /**
     * Gets triggered every time on update
     * 
     * @ORM\PreUpdate
     */
    public function onPreUpdate()
    {
        $this->updated_at = new DateTime("now");
        return $this;
    }

    /**
     * Gets triggered every time on update
     * 
     * @ORM\PreRemove
     */
    public function onPreRemove()
    {
        $this->deleted_at = new DateTime("now");
        return $this;
    }
}