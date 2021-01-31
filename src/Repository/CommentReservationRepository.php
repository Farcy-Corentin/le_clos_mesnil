<?php

namespace App\Repository;

use App\Entity\CommentReservation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CommentReservation|null find($id, $lockMode = null, $lockVersion = null)
 * @method CommentReservation|null findOneBy(array $criteria, array $orderBy = null)
 * @method CommentReservation[]    findAll()
 * @method CommentReservation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CommentReservationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CommentReservation::class);
    }

    // /**
    //  * @return CommentReservation[] Returns an array of CommentReservation objects
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
    public function findOneBySomeField($value): ?CommentReservation
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
