<?php

namespace App\Repository;

use App\Entity\Eragilea;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;


use Doctrine\ORM\EntityManagerInterface;
use Gedmo\Tree\Entity\Repository\NestedTreeRepository;


/**
 * @method Eragilea|null find($id, $lockMode = null, $lockVersion = null)
 * @method Eragilea|null findOneBy(array $criteria, array $orderBy = null)
 * @method Eragilea[]    findAll()
 * @method Eragilea[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EragileaRepository extends NestedTreeRepository
{
    public function __construct(EntityManagerInterface $manager)
    {
        parent::__construct($manager, $manager->getClassMetadata(Eragilea::class));
        //parent::__construct($registry, Eragilea::class);
    }
}
