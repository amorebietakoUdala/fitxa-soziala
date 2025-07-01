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
            ->leftJoin('f.balioespena', 'b')
            ->leftJoin('f.arrazoia', 'a');
            if ( isset($criteria['egoera']) && $criteria['egoera'] !== null) {
                $qb->andWhere("f.egoera = :egoera")
                ->setParameter('egoera', $criteria['egoera']);
            }
            if ( isset($criteria['balioespena']) && $criteria['balioespena'] !== null ) {
                $qb->andWhere("b.id = :balioespena")
                ->setParameter('balioespena', $criteria['balioespena']);
            }
            // if ( isset($criteria['arrazoia']) && $criteria['arrazoia'] !== null ) {
            //     $qb->andWhere("a.id = :arrazoia")
            //     ->setParameter('arrazoia', $criteria['arrazoia']);
            // }
            if ( isset($criteria['arrazoiaBigarrenMaila']) && $criteria['arrazoiaBigarrenMaila'] !== null ) {
                $qb->andWhere("a.id = :arrazoia")
                ->setParameter('arrazoia', $criteria['arrazoiaBigarrenMaila']);
            } else {
                if ( isset($criteria['arrazoia']) && $criteria['arrazoia'] !== null ) {
                    $qb->andWhere("a.id = :arrazoia")
                    ->setParameter('arrazoia', $criteria['arrazoia']);
                }
            }
            if ( isset($criteria['fromDate']) && $criteria['fromDate'] !== null ) {
                $qb->andWhere("f.updated >= :fromDate")
                ->setParameter('fromDate', $criteria['fromDate']);
            }
            if ( isset($criteria['toDate']) && $criteria['toDate'] !== null ) {
                $qb->andWhere("f.updated <= :toDate")
                ->setParameter('toDate', $criteria['toDate']);
            }
            if ( isset($criteria['erabiltzailea']) && $criteria['erabiltzailea'] !== null ) {
                $qb->andWhere("f.erabiltzailea = :erabiltzailea")
                ->setParameter('erabiltzailea', $criteria['erabiltzailea']);
            }
        $result = $qb->getQuery()->getResult();
        return $result;
    }
}
