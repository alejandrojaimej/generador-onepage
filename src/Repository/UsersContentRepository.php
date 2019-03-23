<?php

namespace App\Repository;

use App\Entity\UsersContent;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method UsersContent|null find($id, $lockMode = null, $lockVersion = null)
 * @method UsersContent|null findOneBy(array $criteria, array $orderBy = null)
 * @method UsersContent[]    findAll()
 * @method UsersContent[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UsersContentRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, UsersContent::class);
    }

    // /**
    //  * @return UsersContent[] Returns an array of UsersContent objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('u.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?UsersContent
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
