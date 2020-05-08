<?php


namespace App\Repository;

use App\Entity\Book;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Book|null find($id, $lockMode = null, $lockVersion = null)
 * @method Book|null findOneBy(array $criteria, array $orderBy = null)
 * @method Book[]    findAll()
 * @method Book[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BaseRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry, $entityClass)
    {
        parent::__construct($registry, $entityClass);
    }

    /**
     * @return false|string
     */
    public function getAlias()
    {
        $namespaceClass = explode("\\", $this->getEntityName());
        $className = $namespaceClass[count($namespaceClass)-1];
        $uppers = [];
        preg_match_all("/[A-Z]/", $className, $uppers);
        return strtolower(implode('', $uppers[0]));
    }

    public function getQuery()
    {
        return $this->createQueryBuilder($this->getAlias())
            ->andWhere($this->getAlias().'.deleted_at is null');
    }

}