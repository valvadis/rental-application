<?php

namespace Rental\Infrastructure\Repository;

use Doctrine\ORM\EntityRepository;
use Rental\Domain\Booking\BookingHistory;
use Rental\Domain\Booking\BookingHistoryRepository as BookingHistoryRepositoryInterface;

class BookingHistoryRepository extends EntityRepository implements BookingHistoryRepositoryInterface
{
    public function save(BookingHistory $bookingHistory): void
    {
        $this->getEntityManager()->persist($bookingHistory);
        $this->getEntityManager()->flush();
    }
}
