<?php

namespace Rental\Infrastructure\Repository;

use Doctrine\ORM\EntityRepository;
use Rental\Domain\Apartment\Booking;
use Rental\Domain\Apartment\BookingRepository as BookingRepositoryInterface;

class BookingRepository extends EntityRepository implements BookingRepositoryInterface
{
    public function save(Booking $booking): void
    {
        $this->getEntityManager()->persist($booking);
        $this->getEntityManager()->flush();
    }
}