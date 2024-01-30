<?php

namespace App\Repository;

use App\Entity\Bizikidetza;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Bizikidetza|null find($id, $lockMode = null, $lockVersion = null)
 * @method Bizikidetza|null findOneBy(array $criteria, array $orderBy = null)
 * @method Bizikidetza[]    findAll()
 * @method Bizikidetza[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BizikidetzaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Bizikidetza::class);
    }
}
