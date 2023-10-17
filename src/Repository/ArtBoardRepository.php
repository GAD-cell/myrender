<?php

namespace App\Repository;

use App\Entity\ArtBoard;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ArtBoard>
 *
 * @method ArtBoard|null find($id, $lockMode = null, $lockVersion = null)
 * @method ArtBoard|null findOneBy(array $criteria, array $orderBy = null)
 * @method ArtBoard[]    findAll()
 * @method ArtBoard[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ArtBoardRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ArtBoard::class);
    }

//    /**
//     * @return ArtBoard[] Returns an array of ArtBoard objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('a.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?ArtBoard
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
