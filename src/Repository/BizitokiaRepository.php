<?php

namespace App\Repository;

use App\Entity\Bizitokia;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Bizitokia|null find($id, $lockMode = null, $lockVersion = null)
 * @method Bizitokia|null findOneBy(array $criteria, array $orderBy = null)
 * @method Bizitokia[]    findAll()
 * @method Bizitokia[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BizitokiaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Bizitokia::class);
    }
}
