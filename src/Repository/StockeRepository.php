<?php

namespace App\Repository;

use App\Entity\Stocke;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Stocke>
 *
 * @method Stocke|null find($id, $lockMode = null, $lockVersion = null)
 * @method Stocke|null findOneBy(array $criteria, array $orderBy = null)
 * @method Stocke[]    findAll()
 * @method Stocke[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class StockeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Stocke::class);
    }

//    /**
//     * @return Stocke[] Returns an array of Stocke objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('s.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Stocke
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
