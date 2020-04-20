<?php

namespace App\Repository;

use App\Entity\CommandRow;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CommandRow|null find($id, $lockMode = null, $lockVersion = null)
 * @method CommandRow|null findOneBy(array $criteria, array $orderBy = null)
 * @method CommandRow[]    findAll()
 * @method CommandRow[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CommandRowRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CommandRow::class);
    }

    // /**
    //  * @return CommandRow[] Returns an array of CommandRow objects
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
    public function findOneBySomeField($value): ?CommandRow
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
