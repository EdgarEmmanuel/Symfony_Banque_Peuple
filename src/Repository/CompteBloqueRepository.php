<?php

namespace App\Repository;

use App\Entity\CompteBloque;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CompteBloque|null find($id, $lockMode = null, $lockVersion = null)
 * @method CompteBloque|null findOneBy(array $criteria, array $orderBy = null)
 * @method CompteBloque[]    findAll()
 * @method CompteBloque[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CompteBloqueRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CompteBloque::class);
    }

    // /**
    //  * @return CompteBloque[] Returns an array of CompteBloque objects
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
    public function findOneBySomeField($value): ?CompteBloque
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
