<?php

namespace App\Command;

use App\Repository\BookRepository;

use Elastica\Client;

/**
 * Class ElasticIndexBooksCommand
 * Manage sf command to add book document into index
 *
 * @package App\Command
 */
class ElasticIndexBooksCommand extends ElasticIndexCommand
{
    /**
     * @var string command name
     */
    protected static $defaultName = 'elastic:index-books';

    /**
     * @var String name of ES index
     */
    protected $indexName = "book";

    /**
     * ElasticIndexBooksCommand constructor.
     *
     * @param BookRepository $entityRepository
     * @param Client $client
     */
    public function __construct(BookRepository $entityRepository, Client $client)
    {
        parent::__construct($entityRepository, $client);
    }

    /**
     * @inheritDoc
     * @return array
     */
    protected function getSerializeContext(): array
    {
        return array_merge(['es-index-book'], parent::getSerializeContext());
    }
}
