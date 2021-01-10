<?php

namespace Rental\Query\Repository;

use Doctrine\ORM\EntityRepository;

class BookingQueryRepository extends EntityRepository
{
    public function findAll(): array
    {
        $queryBuilder = $this->createQueryBuilder('b')
            ->addSelect('b')
            ->addSelect('bd')
            ->addSelect('a')
            ->addSelect('hr')
            ->join('b.bookingDays', 'bd')
            ->leftJoin('b.apartment', 'a')
            ->leftJoin('b.hotelRoom', 'hr');

        return $queryBuilder->getQuery()->getArrayResult();
    }
}
