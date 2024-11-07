<?php

namespace App\Repository;

use App\Entity\Recette;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Recette>
 */
class RecetteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Recette::class);
    }

//    /**
//     * @return Recette[] Returns an array of Recette objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('r')
//            ->andWhere('r.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('r.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

    public function foundByOrder($nbRecette = 4)
    {
        return $this->createQueryBuilder('r')
            ->orderBy('r.date', 'DESC')
            ->setMaxResults($nbRecette)
            ->getQuery()
            ->getResult()
        ;
    }

    public function foundByNote($nbRecette = 4)
    {
        return $this->createQueryBuilder('r')
            ->leftJoin('r.commentaires', 'a')
            ->groupBy('r.id')
            ->orderBy('AVG(a.note)', 'DESC')
            ->setMaxResults($nbRecette)
            ->getQuery()
            ->getResult()
        ;
    }

    public function foundByUser($idUser)
    {
        return $this->createQueryBuilder('r')
            ->where('r.idUser = :val')
            ->setParameter(':val', $idUser)
            ->orderBy('r.id', 'DESC')
            ->setMaxResults(1)
            ->getQuery()
            ->getResult()
        ;
    }

    
}
