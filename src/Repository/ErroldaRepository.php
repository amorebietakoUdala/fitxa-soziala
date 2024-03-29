<?php

namespace App\Repository;

use App\Entity\Errolda;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

use Doctrine\ORM\EntityManagerInterface;
use Gedmo\Tree\Entity\Repository\NestedTreeRepository;


/**
 * @method Errolda|null find($id, $lockMode = null, $lockVersion = null)
 * @method Errolda|null findOneBy(array $criteria, array $orderBy = null)
 * @method Errolda[]    findAll()
 * @method Errolda[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ErroldaRepository extends NestedTreeRepository
{
    public function __construct(EntityManagerInterface $manager)
    {
        parent::__construct($manager, $manager->getClassMetadata(Errolda::class));
        //parent::__construct($registry, Errolda::class);
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
