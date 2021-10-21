<?php

namespace App\Repository;

use App\Entity\Arena;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Arena|null find($id, $lockMode = null, $lockVersion = null)
 * @method Arena|null findOneBy(array $criteria, array $orderBy = null)
 * @method Arena[]    findAll()
 * @method Arena[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ArenaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Arena::class);
    }

    // /**
    //  * @return Arena[] Returns an array of Arena objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Arena
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
