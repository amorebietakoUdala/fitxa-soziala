<?php

namespace App\Repository;

use App\Entity\Arrazoia;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

use Doctrine\ORM\EntityManagerInterface;
use Gedmo\Tree\Entity\Repository\NestedTreeRepository;

/**
 * @method Arrazoia|null find($id, $lockMode = null, $lockVersion = null)
 * @method Arrazoia|null findOneBy(array $criteria, array $orderBy = null)
 * @method Arrazoia[]    findAll()
 * @method Arrazoia[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ArrazoiaRepository extends NestedTreeRepository
{
    public function __construct(EntityManagerInterface $manager)
    {
        parent::__construct($manager, $manager->getClassMetadata(Arrazoia::class));
        //parent::__construct($registry, Arrazoia::class);
    }

    public function treeList()
    {
        return $this->createQueryBuilder('n')
            ->add('orderBy','n.root ASC,  n.lft + n.lvl  ASC, n.id ASC')
            ->getQuery()
            ->getResult()
        ;
    }
    
    public function arrazoiaLevelQB(int $level = 0) {
        $qb  = $this->createQueryBuilder('b')
            ->andWhere('b.lvl = :level')
            ->setParameter('level', $level);

        return $qb;
    }    

    public function arrazoiaLevel(int $level = 0) {
        $qb  = $this->arrazoiaLevelQB($level);

        return $qb->getQuery()->getResult();
    }    

    public function arrazoiaByParentQB(int $parent) {
        $qb  = $this->createQueryBuilder('b')
            ->andWhere('b.parent = :parent')
            ->setParameter('parent', $parent);

        return $qb;
    }    

    public function arrazoiaByParent(int $parent) {
        $qb  = $this->arrazoiaByParentQB($parent);

        return $qb->getQuery()->getResult();
    }    

}
