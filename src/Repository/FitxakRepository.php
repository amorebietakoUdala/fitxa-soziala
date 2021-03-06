<?php

namespace App\Repository;

use App\Entity\Fitxak;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Fitxak|null find($id, $lockMode = null, $lockVersion = null)
 * @method Fitxak|null findOneBy(array $criteria, array $orderBy = null)
 * @method Fitxak[]    findAll()
 * @method Fitxak[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FitxakRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Fitxak::class);
    }
    
    public function zerrenda()
    {
        return $this->createQueryBuilder('f')
            ->orderBy('f.id', 'DESC')
            ->getQuery()
            ->getResult()
        ;
    }

    public function findFitxakByCriteria(array $criteria) {
        $qb = $this->createQueryBuilder('f')
            ->innerJoin('f.balioespena', 'b');
            if ( null !== $criteria['egoera']) {
                $qb->andWhere("f.egoera = :egoera")
                ->setParameter('egoera', $criteria['egoera']);
            }
            if ( null !== $criteria['balioespena']) {
                $qb->andWhere("b.id = :balioespena")
                ->setParameter('balioespena', $criteria['balioespena']);
            }
        $result = $qb->getQuery()->getResult();
        return $result;
    }

    // /**
    //  * @return Fitxak[] Returns an array of Fitxak objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('f.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Fitxak
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
