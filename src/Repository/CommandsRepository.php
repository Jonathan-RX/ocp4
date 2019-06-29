<?php

namespace App\Repository;

use App\Entity\Commands;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Commands|null find($id, $lockMode = null, $lockVersion = null)
 * @method Commands|null findOneBy(array $criteria, array $orderBy = null)
 * @method Commands[]    findAll()
 * @method Commands[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CommandsRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Commands::class);
    }

    public function countTicketsDay($date){
        return $this->createQueryBuilder('c')
            ->select('COUNT(c)')
            ->leftJoin('c.tickets', 't')
            ->where('c.date_visit = :dat')
            ->andWhere('c.payment = true')
            ->setParameter('dat', $date)
            ->getQuery()
            ->getSingleScalarResult();
    }

    //public function findAllByDateJoinedByTickets

    // /**
    //  * @return Commands[] Returns an array of Commands objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Commands
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}