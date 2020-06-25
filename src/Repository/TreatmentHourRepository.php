<?php

namespace App\Repository;

use App\Entity\TreatmentHour;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method TreatmentHour|null find($id, $lockMode = null, $lockVersion = null)
 * @method TreatmentHour|null findOneBy(array $criteria, array $orderBy = null)
 * @method TreatmentHour[]    findAll()
 * @method TreatmentHour[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TreatmentHourRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TreatmentHour::class);
    }

    // /**
    //  * @return TreatmentHour[] Returns an array of TreatmentHour objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?TreatmentHour
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
