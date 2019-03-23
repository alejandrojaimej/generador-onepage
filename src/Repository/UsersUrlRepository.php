<?php

namespace App\Repository;

use App\Entity\UsersUrl;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method UsersUrl|null find($id, $lockMode = null, $lockVersion = null)
 * @method UsersUrl|null findOneBy(array $criteria, array $orderBy = null)
 * @method UsersUrl[]    findAll()
 * @method UsersUrl[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UsersUrlRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, UsersUrl::class);
    }

    // /**
    //  * @return UsersUrl[] Returns an array of UsersUrl objects
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
    public function findOneBySomeField($value): ?UsersUrl
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
