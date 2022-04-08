<?php

namespace App\Repository;

use App\Entity\Gite;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Gite|null find($id, $lockMode = null, $lockVersion = null)
 * @method Gite|null findOneBy(array $criteria, array $orderBy = null)
 * @method Gite[]    findAll()
 * @method Gite[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GiteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Gite::class);
    }

    //recherche par id utilisateur
      /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function searchUser($IDUSER)
    {
        return $this->createQueryBuilder('gite')
                    ->leftJoin('gite.user', 'u')
                    ->where("u.id = $IDUSER")
                    ->getQuery()
                    ->getResult();
    }

    //recherche par nom de ville
     /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function searchGiteCity($criteria)
    {
        return $this->createQueryBuilder('g')
                    ->leftJoin('g.city', 'c')
                    ->where('c.id = :cityId')
                    ->setParameter("cityId", $criteria->getCity())
                    ->getQuery()
                    ->getResult();
    }

    
    // /**
    //  * @throws ORMException
    //  * @throws OptimisticLockException
    //  */
    // public function searchGiteTitle($criteria)
    // {
    //     return $this->createQueryBuilder('g')
    //                 ->where('g.title = :title')
    //                 ->setParameter("title", $criteria->getTitle())
    //                 ->getQuery()
    //                 ->getResult();
    // }

}