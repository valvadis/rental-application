<?php

namespace Rental\Application\Handler;

use Rental\Domain\Booking\BookingRepository;

class BookingRejectHandler
{
    private BookingRepository $bookingRepository;

    public function __construct(BookingRepository $bookingRepository)
    {
        $this->bookingRepository = $bookingRepository;
    }

    public function handle(BookingReject $command): void
    {
        $booking = $this->bookingRepository->findOneById($command->getBookingId());
        $booking->reject();

        $this->bookingRepository->save($booking);
    }
}
