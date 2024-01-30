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
}
