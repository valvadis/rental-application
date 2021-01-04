<?php

namespace Rental\Application\Handler;

use Rental\Application\CommandInterface;
use Rental\Application\CommandTrait;

final class BookingAccept implements CommandInterface
{
    use CommandTrait;

    public string $bookingId;

    public function __construct(string $bookingId)
    {
        $this->bookingId = $bookingId;
    }

    public function getBookingId(): string
    {
        return $this->bookingId;
    }
}