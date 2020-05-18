<?php

namespace App\Api\Repository;

use App\Api\Repository\ElasticRepository;

class BookRepository extends ElasticRepository
{
    protected function getIndex(): string
    {
        return 'book';
    }
}