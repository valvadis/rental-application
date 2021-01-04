<?php

namespace Rental\Query\Repository;

use Doctrine\ORM\EntityRepository;
use Rental\Domain\Apartment\Apartment;

class QueryApartmentRepository extends EntityRepository
{
    public function findAll(): array
    {
        $queryBuilder = $this->createQueryBuilder('a')
            ->join('a.rooms', 'r');

        return $queryBuilder->getQuery()->getArrayResult();
    }

    public function findOneById(string $id): Apartment
    {
        $queryBuilder = $this->createQueryBuilder('a')
            ->where('a.id = :id')
            ->setParameter('id', $id);

        return $queryBuilder->getQuery()->getOneOrNullResult();
    }
}