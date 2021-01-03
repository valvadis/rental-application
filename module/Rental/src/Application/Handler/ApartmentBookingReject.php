<?php

namespace Rental\Application\Handler;

use Rental\Application\CommandInterface;

class BookingReject implements CommandInterface
{
    use CommandTrait;

    public string $bookingId;

    public function __construct(string $bookingId)
    {
        $this->bookingId = $bookingId;
    }

    public function getBookingId(): int
    {
        return $this->bookingId;
    }
}