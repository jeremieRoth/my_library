<?php

namespace App\Command;

use App\Entity\BaseEntity;
use App\Repository\BaseRepository;

use DateTime;
use Exception;

use Elastica\Client;
use Elastica\Document;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Annotations\AnnotationReader;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

use Symfony\Component\Serializer\Exception\ExceptionInterface;
use Symfony\Component\Serializer\NameConverter\MetadataAwareNameConverter;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Mapping\Factory\ClassMetadataFactory;
use Symfony\Component\Serializer\Mapping\Loader\AnnotationLoader;
use Symfony\Component\Serializer\Encoder\JsonEncoder;

/**
 * Class ElasticIndexCommand
 * Manage sf command to add entity into ES index
 *
 * @package App\Command
 */
abstract class ElasticIndexCommand extends Command
{
    /**
     * @var ServiceEntityRepository
     */
    protected $entityRepository;

    /**
     * @var Client
     */
    private $client;

    /**
     * ElasticIndexCommand constructor.
     * @param BaseRepository $entityRepository
     * @param Client $client
     */
    public function __construct(BaseRepository $entityRepository, Client $client)
    {
        parent::__construct();
        $this->entityRepository = $entityRepository;
        $this->client = $client;
    }

    /**
     * @inheritDoc
     */
    protected function configure()
    {
        $this
            ->setDescription('Fill ES index from database')
            ->addArgument(
                'index-from-date',
                InputArgument::REQUIRED,
                'Index book since date'
            )
        ;
    }

    /**
     * @inheritDoc
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int
     * @throws Exception
     * @throws ExceptionInterface
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $arg1 = $input->getArgument('index-from-date');

        $dt = new DateTime($arg1);
        $entities = $this->entityRepository->findByUpdatedAfter($dt);
        $io->note(sprintf('There is %s of %s', count($entities), $this->indexName));

        $this->indexDocuments($entities);

        $io->success('You have a new command! Now make it your own! Pass --help to see your options.');

        return 0;
    }

    /**
     * Add document to ES index
     *
     * @param BaseEntity[] $entities List of entity to index in ES
     * @throws ExceptionInterface
     */
    protected function indexDocuments(array $entities)
    {
        $documents = [];

        foreach($entities as $entity) {
            $documents[] = new Document(
                $entity->getId(),
                $this->buildDocument($entity)
            );
        }

        $index = $this->client->getIndex($this->indexName);
        $index->addDocuments($documents);
        $index->refresh();
    }

    /**
     * Serialize $entity from JMS Serialize annotation/param
     * set into Entity class
     *
     * @param $entity Object to serialize
     * @return array|bool|float|int|mixed|string|null
     * @throws ExceptionInterface
     */
    protected function buildDocument($entity)
    {
        $classMetadataFactory = new ClassMetadataFactory(new AnnotationLoader(new AnnotationReader()));
        $metadataAwareNameConverter = new MetadataAwareNameConverter($classMetadataFactory);

        $normalizer = new ObjectNormalizer($classMetadataFactory, $metadataAwareNameConverter);
        $serializer = new Serializer([$normalizer], ['json' => new JsonEncoder()]);

        return $serializer->normalize($entity, null, ['groups' => $this->getSerializeContext()]);
    }

    /**
     * Return an array with serialize group name
     * to define witch field need to serialize
     *
     * @return array
     */
    protected function getSerializeContext(): array
    {
        return ['es-index'];
    }
}
