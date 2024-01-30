<?php

namespace App\Repository;

use App\Entity\Herria;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Herria|null find($id, $lockMode = null, $lockVersion = null)
 * @method Herria|null findOneBy(array $criteria, array $orderBy = null)
 * @method Herria[]    findAll()
 * @method Herria[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class HerriaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Herria::class);
    }


    public function search($value)
    {
        return $this->createQueryBuilder('h')
            ->orderBy('h.id', 'ASC')
            ->getQuery()->getArrayResult() 
        ;
    }
}
