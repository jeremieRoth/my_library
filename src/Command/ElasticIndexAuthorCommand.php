<?php

namespace App\Command;

use App\Repository\AuthorRepository;

use Elastica\Client;

/**
 * Class ElasticIndexAuthorCommand
 * Manage sf command to add author document into index
 *
 * @package App\Command
 */
class ElasticIndexAuthorCommand extends ElasticIndexCommand
{
    /**
     * @var string command name
     */
    protected static $defaultName = 'elastic:index-author';

    /**
     * @var String name of ES index
     */
    protected $indexName = "author";

    /**
     * ElasticIndexAuthorCommand constructor.
     *
     * @param AuthorRepository $entityRepository
     * @param Client $client
     */
    public function __construct(AuthorRepository $entityRepository, Client $client)
    {
        parent::__construct($entityRepository, $client);
    }

    /**
     * @inheritDoc
     * @return array
     */
    protected function getSerializeContext(): array
    {
        return array_merge(['es-index-author'], parent::getSerializeContext());
    }
}
