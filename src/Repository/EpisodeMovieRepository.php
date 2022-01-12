<?php

namespace App\Repository;

use App\Entity\EpisodeMovie;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method EpisodeMovie|null find($id, $lockMode = null, $lockVersion = null)
 * @method EpisodeMovie|null findOneBy(array $criteria, array $orderBy = null)
 * @method EpisodeMovie[]    findAll()
 * @method EpisodeMovie[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EpisodeMovieRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, EpisodeMovie::class);
    }

    // /**
    //  * @return EpisodeMovie[] Returns an array of EpisodeMovie objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('e.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?EpisodeMovie
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
