<?php

namespace App\Repository;

use App\Entity\Person;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Query\Parameter;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Person>
 */
class PersonRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Person::class);
    }

    /**
     * @return Person[] Returns an array of Person objects
     */
    public function findByParams(array $params): array
    {
        $queryBuilder = $this->createQueryBuilder("p");

        if ($params['name'] ?? null){
            $queryBuilder->andWhere('p.name = :name');
            $queryBuilder->setParameter('name', $params['name']);
        }
        if ($params['email'] ?? null){
            $queryBuilder->andWhere('p.email = :email');
            $queryBuilder->setParameter('email', $params['email']);
        }
        if ($params['telephone'] ?? null){
            $queryBuilder->andWhere('p.telephone = :telephone');
            $queryBuilder->setParameter('telephone', $params['telephone']);
        }

        return $queryBuilder
            ->orderBy('p.id', 'ASC')
            ->getQuery()
            ->getResult();

//        $paramsQuery = new ArrayCollection(array(
//            new Parameter('name', $params['name']|| [] ),
//            new Parameter('email', $params['email']),
//            new Parameter('telephone', $params['telephone']),
//        ));
//        return $this->createQueryBuilder('p')
//            ->andWhere("p.name = :name AND p.email = :email AND p.telephone = :telephone")
//            ->setParameters($paramsQuery)
//            ->orderBy('p.id', 'ASC')
//            ->getQuery()
//            ->getResult()
//        ;
    }

    public function findOneById(int $value): ?Person
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.id = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
}
