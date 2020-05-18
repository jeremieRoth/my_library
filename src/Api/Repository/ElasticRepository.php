<?php

namespace App\Api\Repository;

use Elastica\Client;
use Elastica\Query;
use Elastica\Query\BoolQuery;
use Elastica\Query\MultiMatch;
use Elastica\ResultSet;

abstract class ElasticRepository
{
    private static $indexName = "book";

    private $client;

    /**
     * ElasticRepository constructor.
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;//new Client(['host' => 'localhost', 'port' => 9200]);
    }

    /**
     * @param $query
     * @param int $limit
     * @param int $offset
     * @return array
     */
    public function findDocument($query, $limit = 50, $offset = 0)
    {
        $match = new MultiMatch();
        $match->setQuery($query);
        $match->setFields(['title']);

        $bool = new BoolQuery();
        $bool->addMust($match);

        $elasticQuery = new Query($bool);
        $elasticQuery->setSize($limit);
        $elasticQuery->setFrom($offset);

        $foundPosts = $this->client->getIndex($this->getIndex())->search($elasticQuery);

        return $this->formatResponse($foundPosts);
    }

    /**
     * @param int $limit
     * @param int $offset
     * @return array
     */
    public function findAllDocument($limit = 50, $offset = 0)
    {
        $elasticQuery = new Query();
        $elasticQuery->setSize($limit);
        $elasticQuery->setFrom($offset);

        $foundPosts = $this->client->getIndex($this->getIndex())->search($elasticQuery);

        return $this->formatResponse($foundPosts);
    }

    /**
     * @param ResultSet $results
     * @return array
     */
    private function formatResponse(ResultSet $results)
    {
        $items = [];
        foreach ($results->getResults() as $result) {
            $items[] = $result->getSource();
        }

        return [
            'total' => $results->getTotalHits(),
            'items' => $items
        ];
    }

    /**
     * @return string
     */
    abstract protected function getIndex(): string;
}
