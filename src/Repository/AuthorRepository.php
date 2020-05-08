<?php

namespace App\Repository;

use App\Entity\Author;
use Doctrine\Persistence\ManagerRegistry;

class AuthorRepository extends BaseRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Author::class);
    }
}
