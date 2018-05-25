<?php

namespace App\Repository;

use App\Entity\ConsultCategory;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method ConsultCategory|null find($id, $lockMode = null, $lockVersion = null)
 * @method ConsultCategory|null findOneBy(array $criteria, array $orderBy = null)
 * @method ConsultCategory[]    findAll()
 * @method ConsultCategory[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserCategoryRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, ConsultCategory::class);
    }

//    /**
//     * @return UserCategory[] Returns an array of UserCategory objects
//     */
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
    public function findOneBySomeField($value): ?UserCategory
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
