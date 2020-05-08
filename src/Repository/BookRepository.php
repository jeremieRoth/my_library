<?php

namespace App\Repository;

use App\Entity\Book;
use DateTime;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Book|null find($id, $lockMode = null, $lockVersion = null)
 * @method Book|null findOneBy(array $criteria, array $orderBy = null)
 * @method Book[]    findAll()
 * @method Book[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BookRepository extends BaseRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Book::class);
    }

    public function findByUpdatedAfter(DateTime $date)
    {
        return $this->getQuery()
            ->andWhere('b.updated_at > :val')
            ->setParameter('val', $date)
            ->getQuery()
            ->getResult();
    }
}
