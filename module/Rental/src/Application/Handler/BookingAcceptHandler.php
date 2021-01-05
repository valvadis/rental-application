<?php

namespace Rental\Application\Handler;

use Rental\Domain\Booking\BookingRepository;

class BookingAcceptHandler
{
    private BookingRepository $bookingRepository;

    public function __construct(BookingRepository $bookingRepository)
    {
        $this->bookingRepository = $bookingRepository;
    }

    public function handle(BookingAccept $command): void
    {
        $booking = $this->bookingRepository->findOneById($command->getBookingId());
        $booking->accept();

        $this->bookingRepository->save($booking);
    }
}
