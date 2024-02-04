<?php

namespace App\Repository;

use App\Entity\Proveidor;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Proveidor>
 *
 * @method Proveidor|null find($id, $lockMode = null, $lockVersion = null)
 * @method Proveidor|null findOneBy(array $criteria, array $orderBy = null)
 * @method Proveidor[]    findAll()
 * @method Proveidor[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProveidorRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Proveidor::class);
    }

//    /**
//     * @return Proveidor[] Returns an array of Proveidor objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('p.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Proveidor
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
