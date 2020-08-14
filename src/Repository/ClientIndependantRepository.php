<?php

namespace App\Repository;

use App\Entity\ClientIndependant;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ClientIndependant|null find($id, $lockMode = null, $lockVersion = null)
 * @method ClientIndependant|null findOneBy(array $criteria, array $orderBy = null)
 * @method ClientIndependant[]    findAll()
 * @method ClientIndependant[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ClientIndependantRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ClientIndependant::class);
    }

    // /**
    //  * @return ClientIndependant[] Returns an array of ClientIndependant objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ClientIndependant
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
