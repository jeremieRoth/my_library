<?php

namespace App\Command;

use Elastica\Client;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

use Symfony\Component\Yaml\Yaml;

/**
 * Class ElasticIndexBuilderCommand
 * Manage sf command to create ES index
 *
 * @package App\Command
 */
class ElasticIndexBuilderCommand extends Command
{
    /**
     * @var string command name
     */
    protected static $defaultName = 'elastic:index-builder';

    /**
     * @var Client ES client
     */
    private $client;

    /**
     * ElasticIndexBuilderCommand constructor.
     * @param Client $client ES Client injected by sf
     */
    public function __construct(Client $client)
    {
        parent::__construct();
        $this->client = $client;
    }

    /**
     * @inheritDoc
     */
    protected function configure()
    {
        $this
            ->setDescription('Create elasticsearch index')
            ->addArgument(
                'index-name',
                InputArgument::REQUIRED,
                'index to generate [book|author|all]')
        ;
    }

    /**
     * @inheritDoc
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $indexName = $input->getArgument('index-name');

        if (!$io->confirm("If index existe all data will be erase")) {
            return 0;
        }

        $io->note(sprintf('Creation of %s index', $indexName));

        if (!$this->createIndex($indexName)) {
            $io->error(sprintf('Error during index creation'));
            return 1;
        }

        $io->success(sprintf('Index %s created', $indexName));
        return 0;
    }

    /**
     * Create index by ES Client
     *
     * @param string $indexName name of index will be create
     * @return bool
     */
    private function createIndex(string $indexName)
    {
        $index = $this->client->getIndex($indexName);

        $mapping = Yaml::parse(
          file_get_contents(
            __DIR__.'/../../config/elasticsearch/index_'.$indexName.'.yml'
          )
        );

        $response = $index->create($mapping, true);
        return $response->isOk();
    }
}
