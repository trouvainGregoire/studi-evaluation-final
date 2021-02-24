<?php

namespace App\Repository;

use App\Entity\Hideway;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Hideway|null find($id, $lockMode = null, $lockVersion = null)
 * @method Hideway|null findOneBy(array $criteria, array $orderBy = null)
 * @method Hideway[]    findAll()
 * @method Hideway[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class HidewayRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Hideway::class);
    }

    // /**
    //  * @return Hideway[] Returns an array of Hideway objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('h')
            ->andWhere('h.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('h.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Hideway
    {
        return $this->createQueryBuilder('h')
            ->andWhere('h.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
