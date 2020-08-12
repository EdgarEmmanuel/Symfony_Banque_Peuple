<?php

namespace App\Repository;

use App\Entity\ResponsableCompte;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ResponsableCompte|null find($id, $lockMode = null, $lockVersion = null)
 * @method ResponsableCompte|null findOneBy(array $criteria, array $orderBy = null)
 * @method ResponsableCompte[]    findAll()
 * @method ResponsableCompte[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ResponsableCompteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ResponsableCompte::class);
    }

    // /**
    //  * @return ResponsableCompte[] Returns an array of ResponsableCompte objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('r.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ResponsableCompte
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
