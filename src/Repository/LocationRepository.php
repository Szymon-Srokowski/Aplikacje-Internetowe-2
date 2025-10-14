<?php

namespace App\Repository;

use App\Entity\Location;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Location>
 */
class LocationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Location::class);
    }

    public function findOneByCityAndCountry(string $city, ?string $country): ?Location
    {
        $qb = $this->createQueryBuilder('l')
            ->andWhere('LOWER(l.city) = LOWER(:city)')
            ->setParameter('city', $city);

        if ($country !== null && $country !== '') {
            $qb->andWhere('UPPER(l.country) = UPPER(:country)')
                ->setParameter('country', $country);
        }

        return $qb->setMaxResults(1)->getQuery()->getOneOrNullResult();
    }

    //    /**
    //     * @return Location[] Returns an array of Location objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('l')
    //            ->andWhere('l.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('l.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Location
    //    {
    //        return $this->createQueryBuilder('l')
    //            ->andWhere('l.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
