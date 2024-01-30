<?php

namespace App\Repository;

use App\Entity\Nazionalitatea;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

use Doctrine\ORM\EntityManagerInterface;
use Gedmo\Tree\Entity\Repository\NestedTreeRepository;

/**
 * @method Nazionalitatea|null find($id, $lockMode = null, $lockVersion = null)
 * @method Nazionalitatea|null findOneBy(array $criteria, array $orderBy = null)
 * @method Nazionalitatea[]    findAll()
 * @method Nazionalitatea[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class NazionalitateaRepository extends NestedTreeRepository
{
    public function __construct(EntityManagerInterface $manager)
    {
        parent::__construct($manager, $manager->getClassMetadata(Nazionalitatea::class));
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
