<?php

namespace App\Repository;

use App\Entity\Agios;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Agios|null find($id, $lockMode = null, $lockVersion = null)
 * @method Agios|null findOneBy(array $criteria, array $orderBy = null)
 * @method Agios[]    findAll()
 * @method Agios[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AgiosRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Agios::class);
    }

    // /**
    //  * @return Agios[] Returns an array of Agios objects
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
    public function findOneBySomeField($value): ?Agios
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
