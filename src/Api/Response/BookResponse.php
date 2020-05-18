<?php 

namespace App\Api\Response;

use App\Api\Response\PaginationResponse;

use OpenApi\Annotations as OA;

/**
 * @OA\Schema()
 */
class BookResponse extends PaginationResponse
{
    /**
     * List of book
     * @var Book[]
     * 
     * @OA\Property(type="array", @OA\Items(ref="#/components/schemas/Book"))
     */
    protected $items;
}