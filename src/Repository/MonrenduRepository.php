<?php

namespace App\Repository;

use App\Entity\Monrendu;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Monrendu>
 *
 * @method Monrendu|null find($id, $lockMode = null, $lockVersion = null)
 * @method Monrendu|null findOneBy(array $criteria, array $orderBy = null)
 * @method Monrendu[]    findAll()
 * @method Monrendu[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MonrenduRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Monrendu::class);
    }

//    /**
//     * @return Monrendu[] Returns an array of Monrendu objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('m')
//            ->andWhere('m.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('m.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Monrendu
//    {
//        return $this->createQueryBuilder('m')
//            ->andWhere('m.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
