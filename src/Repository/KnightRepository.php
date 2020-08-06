<?php

namespace App\Repository;

use App\Entity\Knight;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Knight|null find($id, $lockMode = null, $lockVersion = null)
 * @method Knight|null findOneBy(array $criteria, array $orderBy = null)
 * @method Knight[]    findAll()
 * @method Knight[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class KnightRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Knight::class);
    }

     /**
      * @return Knight[] Returns an array of Knight objects
      */
    public function getKnights($limit, $offset)
    {
        return $this->createQueryBuilder('k')
            ->orderBy('k.id', 'ASC')
            ->setMaxResults($limit)
            ->setFirstResult($offset)
            ->getQuery()
            ->getResult()
        ;
    }


}
