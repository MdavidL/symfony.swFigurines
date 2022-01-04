<?php

namespace App\Repository;

use App\Entity\Productadd;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class ProductaddRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Productadd::class);
    }

    public function searchByProducts($word)
    {
        $queryBuilder = $this->createQueryBuilder('product');

        $query = $queryBuilder->select('product')
            ->where( $qb->expr()->andX(
                $qb->expr()->orX('product.name LIKE :word')
            ->setParameter('word', '%'.$word.'%')
            ->getQuery();

        return $query->getResult();
    }
    // /**
    //  * @return Productadd[] Returns an array of Productadd objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Productadd
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}