<?php

namespace App\Repository;

use App\Entity\User;
use App\Entity\UserBookCollection;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method UserBookCollection|null find($id, $lockMode = null, $lockVersion = null)
 * @method UserBookCollection|null findOneBy(array $criteria, array $orderBy = null)
 * @method UserBookCollection[]    findAll()
 * @method UserBookCollection[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserBookCollectionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, UserBookCollection::class);
    }

    /**
     * return a array contain series and books
     *
     * @param User $user
     * @return array
     */
    public function findSeriesAndBookByUser(User $user)
    {
        $books = $this->findOneByUser($user)->getBookList()->getValues();

        $bookListFormated = [];
        $seriesList = [];
        foreach ($books as $book){
            $bookListFormated[$book->getSeries()->getId()][] = $book;
            if(!in_array($book->getSeries(),$seriesList)){
                $seriesList[] = $book->getSeries();
            }
        }
        $result = ['series' => $seriesList, 'books' => $bookListFormated];

        return $result;
    }
    // /**
    //  * @return UserBookCollection[] Returns an array of UserBookCollection objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('u.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?UserBookCollection
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
