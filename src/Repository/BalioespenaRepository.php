<?php

namespace App\Repository;

use App\Entity\Balioespena;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

use Doctrine\ORM\EntityManagerInterface;
use Gedmo\Tree\Entity\Repository\NestedTreeRepository;

/**
 * @method Balioespena|null find($id, $lockMode = null, $lockVersion = null)
 * @method Balioespena|null findOneBy(array $criteria, array $orderBy = null)
 * @method Balioespena[]    findAll()
 * @method Balioespena[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BalioespenaRepository extends NestedTreeRepository
{
    public function __construct(EntityManagerInterface $manager)
    {
        parent::__construct($manager, $manager->getClassMetadata(Balioespena::class));
        //parent::__construct($registry, Balioespena::class);
    }

    public function treeList()
    {
        return $this->createQueryBuilder('n')
            ->add('orderBy','n.root ASC,  n.lft + n.lvl  ASC, n.id ASC')
            ->getQuery()
            ->getResult()
        ;
    }

    public function balioespenaLevelQB(int $level = 0) {
        $qb  = $this->createQueryBuilder('b')
            ->andWhere('b.lvl = :level')
            ->setParameter('level', $level);

        return $qb;
    }
}
