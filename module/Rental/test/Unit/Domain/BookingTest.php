<?php

namespace RentalTest\Unit\Domain;

use Doctrine\Common\Collections\ArrayCollection;
use PHPUnit\Framework\TestCase;
use Rental\Domain\Apartment\ApartmentFactory;
use Rental\Domain\Booking\ApartmentBooking;
use Rental\Domain\Booking\BookingStatus;

class BookingTest extends TestCase
{
    public function testBookingChangingStatusCorrectly(): void
    {
        $days = new ArrayCollection(['2050-01-01', '2050-01-02', '2050-01-03', '2050-01-05', '2050-01-09']);
        $apartment = (new ApartmentFactory())->create(
            'OWNER-ID',
            'Example street',
            '12-345',
            '12',
            '21',
            'City',
            'Country',
            'Some description',
            [
                ['name' => 'Room 1', 'size' => 28],
                ['name' => 'Room 2', 'size' => 32],
            ]
        );

        $booking = new ApartmentBooking($apartment, 'TENANT-ID', $days);

        $this->assertIsObject($booking);
        $this->assertEquals(BookingStatus::OPENED, $booking->getStatus());

        $booking->accept();
        $this->assertEquals(BookingStatus::ACCEPTED, $booking->getStatus());

        $booking->reject();
        $this->assertEquals(BookingStatus::REJECTED, $booking->getStatus());
    }
}
