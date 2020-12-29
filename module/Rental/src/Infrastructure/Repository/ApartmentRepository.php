<?php

namespace Rental\Infrastructure\Repository;

use Doctrine\ORM\EntityRepository;
use Rental\Domain\Apartment\Apartment;
use Rental\Domain\Apartment\ApartmentRepository as ApartmentRepositoryInterface;

class ApartmentRepository extends EntityRepository implements ApartmentRepositoryInterface
{
    public function save(Apartment $apartment): void
    {
        $this->getEntityManager()->persist($apartment);
        $this->getEntityManager()->flush();
    }
}