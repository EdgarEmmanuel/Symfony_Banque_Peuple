<?php

namespace App\Repository;

use App\Entity\ClientSalarie;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ClientSalarie|null find($id, $lockMode = null, $lockVersion = null)
 * @method ClientSalarie|null findOneBy(array $criteria, array $orderBy = null)
 * @method ClientSalarie[]    findAll()
 * @method ClientSalarie[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ClientSalarieRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ClientSalarie::class);
    }

    // /**
    //  * @return ClientSalarie[] Returns an array of ClientSalarie objects
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
    public function findOneBySomeField($value): ?ClientSalarie
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
