<?php

namespace App\Repository;

use App\Entity\RelativeHasMedic;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method RelativeHasMedic|null find($id, $lockMode = null, $lockVersion = null)
 * @method RelativeHasMedic|null findOneBy(array $criteria, array $orderBy = null)
 * @method RelativeHasMedic[]    findAll()
 * @method RelativeHasMedic[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RelativeHasMedicRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, RelativeHasMedic::class);
    }

    // /**
    //  * @return RelativeHasMedic[] Returns an array of RelativeHasMedic objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('r.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?RelativeHasMedic
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
