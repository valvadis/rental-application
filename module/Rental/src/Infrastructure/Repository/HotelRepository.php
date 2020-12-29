<?php

namespace Rental\Infrastructure\Repository;

use Doctrine\ORM\EntityRepository;
use Rental\Domain\Hotel\Hotel;
use Rental\Domain\Hotel\HotelRepository as HotelRepositoryInterface;

class HotelRepository extends EntityRepository implements HotelRepositoryInterface
{
    public function save(Hotel $hotel): void
    {
        $this->getEntityManager()->persist($hotel);
        $this->getEntityManager()->flush();
    }
}