<?php

namespace App\Repository;

use App\Entity\Gaitasuna;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Gaitasuna|null find($id, $lockMode = null, $lockVersion = null)
 * @method Gaitasuna|null findOneBy(array $criteria, array $orderBy = null)
 * @method Gaitasuna[]    findAll()
 * @method Gaitasuna[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GaitasunaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Gaitasuna::class);
    }

    // /**
    //  * @return Gaitasuna[] Returns an array of Gaitasuna objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('g.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Gaitasuna
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
