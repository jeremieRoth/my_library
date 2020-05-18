<?php

namespace App\Api\Response;

use JsonSerializable;
use OpenApi\Annotations as OA;

abstract class PaginationResponse implements JsonSerializable
{
    /**
     * Total results found
     * @var integer
     *
     * @OA\Property()
     */
    protected $total;
    
    /**
     * Offset request
     * @var integer
     *
     * @OA\Property()
     */
    protected $offset;
    
    /**
     * maximum number of results
     * @var integer
     *
     * @OA\Property()
     */
    protected $limit;

    /**
     * @var EntityBase[]
     */
    protected $items;

    public function __construct($items, $limit, $offset, $total)
    {
        $this->items    = $items;
        $this->limit    = $limit;
        $this->offset   = $offset;
        $this->total    = $total;
    }

    public function jsonSerialize()
    {
        return [
            'total' => $this->total,
            'limit' => $this->limit,
            'offset' => $this->offset,
            'items' => $this->items
        ];
    }
}