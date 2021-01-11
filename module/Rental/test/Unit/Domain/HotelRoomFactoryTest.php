<?php

namespace RentalTest\Unit\Domain;

use PHPUnit\Framework\TestCase;
use Rental\Domain\Hotel\HotelFactory;
use Rental\Domain\Hotel\HotelRoom;
use Rental\Domain\Hotel\HotelRoomFactory;

class HotelRoomFactoryTest extends TestCase
{
    public function testHotelRoomFactoryCreatesObjectCorrectly(): void
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

        $this->assertIsObject($hotelRoom);
        $this->assertEquals(HotelRoom::class, get_class($hotelRoom));
    }
}
