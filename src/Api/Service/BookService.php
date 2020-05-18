<?php

namespace App\Api\Service;

use App\Api\Repository\BookRepository;
use App\Api\Response\BookResponse;

class BookService
{
    private $bookRepository;


    public function __construct(BookRepository $bookRepository)
    {
        $this->bookRepository = $bookRepository;
    }

    public function getBook($query = '', $offset = 0, $limit = 50)
    {
        if (!empty($query)) {
            $response = $this->bookRepository->findDocument($query);
        } else {
            $response = $this->bookRepository->findAllDocument();
        }

        return new BookResponse(
            $response['items'],
            $limit,
            $offset,
            $response['total']
        );
    }

}