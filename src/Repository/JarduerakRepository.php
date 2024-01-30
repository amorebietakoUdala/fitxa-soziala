<?php

namespace App\Repository;

use App\Entity\Jarduerak;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

use Doctrine\ORM\EntityManagerInterface;
use Gedmo\Tree\Entity\Repository\NestedTreeRepository;

/**
 * @method Jarduerak|null find($id, $lockMode = null, $lockVersion = null)
 * @method Jarduerak|null findOneBy(array $criteria, array $orderBy = null)
 * @method Jarduerak[]    findAll()
 * @method Jarduerak[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class JarduerakRepository extends NestedTreeRepository
{
    public function __construct(EntityManagerInterface $manager)
    {
        parent::__construct($manager, $manager->getClassMetadata(Jarduerak::class));
    }

    public function treeList()
    {
        return $this->createQueryBuilder('n')
            ->add('orderBy','n.root ASC,  n.lft + n.lvl  ASC, n.id ASC')
            ->getQuery()
            ->getResult()
        ;
    }
}
