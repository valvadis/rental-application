<?php

namespace Rental\Query\Repository;

use Doctrine\ORM\EntityRepository;

class ApartmentQueryRepository extends EntityRepository
{
    public function findAll(): array
    {
        $queryBuilder = $this->createQueryBuilder('a')
            ->addSelect('r')
            ->join('a.rooms', 'r');

        return $queryBuilder->getQuery()->getArrayResult();
    }
}
