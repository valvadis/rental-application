<?php

namespace RentalTest\Unit\Application;

use Doctrine\Common\Collections\ArrayCollection;
use PHPUnit\Framework\TestCase;
use Prophecy\Argument;
use Rental\Application\Handler\BookingAccept;
use Rental\Application\Handler\BookingAcceptHandler;
use Rental\Domain\Apartment\Apartment;
use Rental\Domain\Booking\ApartmentBooking;
use Rental\Domain\Booking\Booking;
use Rental\Domain\Booking\BookingRepository;
use Rental\Domain\Booking\BookingStatus;

class BookingAcceptHandlerTest extends TestCase
{
    public function testBookingCanBeAccepted()
    {
        $days = new ArrayCollection(['2050-01-01']);
        $apartment = $this->prophesize(Apartment::class);
        $booking = new ApartmentBooking($apartment->reveal(), 'TENANT-ID', $days);

        $bookingRepository = $this->prophesize(BookingRepository::class);
        $bookingRepository->findOneById(Argument::type('string'))
            ->willReturn($booking)
            ->shouldBeCalled();

        $bookingRepository->save(Argument::type(Booking::class))
            ->shouldBeCalled();

        $bookingAcceptHandler = new BookingAcceptHandler($bookingRepository->reveal());
        $bookingAccept = new BookingAccept('BOOKING-ACCEPT-ID');

        $bookingAcceptHandler->handle($bookingAccept);

        $this->assertEquals(BookingStatus::ACCEPTED, $booking->getStatus());
    }
}
