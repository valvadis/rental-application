<?php

namespace RentalTest\Domain;

use PHPUnit\Framework\TestCase;
use Rental\Domain\Hotel\Hotel;
use Rental\Domain\Hotel\HotelFactory;

class HotelFactoryTest extends TestCase
{
    public function testHotelFactoryCreatesObjectCorrectly(): void
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

        $this->assertIsObject($hotel);
        $this->assertEquals(Hotel::class, get_class($hotel));
    }
}