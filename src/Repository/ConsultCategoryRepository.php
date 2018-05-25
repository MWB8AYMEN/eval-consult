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
class ConsultCategoryRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, ConsultCategory::class);
    }

//    /**
//     * @return ConsultCategory[] Returns an array of ConsultCategory objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ConsultCategory
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
