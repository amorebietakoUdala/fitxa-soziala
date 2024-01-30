<?php

namespace App\Repository;

use App\Entity\DokumentuMota;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method DokumentuMota|null find($id, $lockMode = null, $lockVersion = null)
 * @method DokumentuMota|null findOneBy(array $criteria, array $orderBy = null)
 * @method DokumentuMota[]    findAll()
 * @method DokumentuMota[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DokumentuMotaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DokumentuMota::class);
    }
}
