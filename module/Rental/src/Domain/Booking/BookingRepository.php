<?php

namespace Rental\Domain\Booking;

interface BookingRepository
{
    public function save(Booking $booking): void;

    public function findOneById(string $id): Booking;
}
