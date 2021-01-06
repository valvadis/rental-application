<?php

namespace Rental\Domain\Booking;

interface BookingHistoryRepository
{
    public function save(BookingHistory $bookingHistory): void;
}
