<?php

namespace RentalTest\Unit\Application;

use PHPUnit\Framework\TestCase;
use Prophecy\Argument;
use Rental\Application\Service\HotelService;
use Rental\Domain\Hotel\Hotel;
use Rental\Domain\Hotel\HotelRepository;

class HotelServiceTest extends TestCase
{
    public function testHotelServiceAddsHotelCorrectly()
    {
        $hotelRepository = $this->prophesize(HotelRepository::class);
        $hotelRepository->save(Argument::type(Hotel::class))
            ->shouldBeCalled();

        $apartmentService = new HotelService(
            $hotelRepository->reveal()
        );

        $apartmentService->add(
            'HOTEL-NAME',
            'Example street',
            '12-345',
            '12',
            '21',
            'City',
            'Country'
        );
    }
}
