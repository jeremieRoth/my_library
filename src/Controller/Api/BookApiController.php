<?php

namespace App\Controller\Api;

use App\Api\Repository\BookRepository;
use App\Api\Response\BookResponse;
use App\Api\Service\BookService;

use Exception;

use OpenApi\Annotations as OA;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Mange all api route for book document
 *
 * @Route("/api/book")
 */
class BookApiController extends AbstractController
{
    /**
     * List book document
     *
     * @Route("/", name="get_book")
     *
     * @param BookService $bookService
     * @return JsonResponse
     */
    public function index(BookService $bookService)
    {
        $response = $bookService->getBook();

        return new JsonResponse($response);
    }
}
