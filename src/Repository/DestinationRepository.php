<?php

namespace App\Repository;

use App\Entity\Destination;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Destination>
 */
class DestinationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Destination::class);
    }

   public function getDestinations(){
       $query =  $this->createQueryBuilder('d')
           ->select('d.id','d.name','d.description','d.picture','d.price')
           ->addSelect("CONCAT(d.duration, ' days') AS duration");
       return $query->getQuery()->getResult(2);

   }
}
