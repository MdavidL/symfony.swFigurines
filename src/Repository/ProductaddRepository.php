<?php

namespace App\Repository;

use App\Entity\Productadd;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Productadd|null find($id, $lockMode = null, $lockVersion = null)
 * @method Productadd|null findOneBy(array $criteria, array $orderBy = null)
 * @method Productadd[]    findAll()
 * @method Productadd[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProductaddRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Productadd::class);
    }

    public function searchByName($word)
    {
        // I use the createQueryBuilder method for the datas recovery
        $queryBuilder = $this->createQueryBuilder('product');
        // Here are the parameters
        $query = $queryBuilder->select('product')
            ->where('product.name LIKE :word')
            ->setParameter('word', '%'.$word.'%')
            ->orderBy('product.name', 'ASC')
            ->getQuery();
        //I call the getResult for the result
        return $query->getResult();
    }
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

