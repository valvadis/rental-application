<?php

namespace RentalTest\Domain;

use Doctrine\Common\Collections\ArrayCollection;
use PHPUnit\Framework\TestCase;
use Rental\Domain\Booking\HotelRoomBooking;
use Rental\Domain\Hotel\HotelFactory;
use Rental\Domain\Hotel\HotelRoomFactory;

class HotelRoomTest extends TestCase
{
    public function testHotelCanBeBookCorrectly(): void
    {
        $hotel = (new HotelFactory())->create(
            'HOTEL-NAME',
            'Example street',
            '12-345',
            '12',
            '21',
            'City',
            'Country'
        );

        $hotelRoom = (new HotelRoomFactory())->create(
            $hotel,
            1,
            'Short description',
            [
                ['name' => 'Room 1', 'length' => 28],
                ['name' => 'Room 2', 'length' => 32],
            ]
        );

        $hotelRoomBooking = $hotelRoom->book('TENANT-ID', new ArrayCollection());

        $this->assertIsObject($hotelRoomBooking);
        $this->assertEquals(HotelRoomBooking::class, get_class($hotelRoomBooking));
    }
}