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
    
    // /**
    //  * @return Arrazoia[] Returns an array of Arrazoia objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('j')
            ->andWhere('j.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('j.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Arrazoia
    {
        return $this->createQueryBuilder('j')
            ->andWhere('j.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
