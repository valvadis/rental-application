<?php

namespace Rental\Infrastructure\Repository;

use Doctrine\ORM\EntityRepository;
use Rental\Domain\Booking\Booking;
use Rental\Domain\Booking\BookingDay;
use Rental\Domain\Booking\BookingRepository as BookingRepositoryInterface;

class BookingRepository extends EntityRepository implements BookingRepositoryInterface
{
    public function save(Booking $booking): void
    {
        /** @var BookingDay $day */
        foreach ($booking->getDays() as $day) {
            $day->setBooking($booking);
        }

        $this->getEntityManager()->persist($booking);
        $this->getEntityManager()->flush();
    }
}