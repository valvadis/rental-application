<?php

namespace RentalTest\Unit\Application;

use Doctrine\Common\Collections\Collection;
use PHPUnit\Framework\TestCase;
use Prophecy\Argument;
use Rental\Application\Service\HotelRoomService;
use Rental\Domain\Booking\BookingRepository;
use Rental\Domain\Booking\HotelRoomBooking;
use Rental\Domain\Hotel\HotelFactory;
use Rental\Domain\Hotel\HotelRepository;
use Rental\Domain\Hotel\HotelRoom;
use Rental\Domain\Hotel\HotelRoomBooked;
use Rental\Domain\Hotel\HotelRoomRepository;

class HotelRoomServiceTest extends TestCase
{
    public function testHotelRoomServiceAddsHotelRoomCorrectly()
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

        $hotelRoomRepository = $this->prophesize(HotelRoomRepository::class);
        $hotelRoomRepository->save(Argument::type(HotelRoom::class))
            ->shouldBeCalled();

        $hotelRepository = $this->prophesize(HotelRepository::class);
        $hotelRepository->findOneById(Argument::type('string'))
            ->willReturn($hotel)
            ->shouldBeCalled();

        $bookingRepository = $this->prophesize(BookingRepository::class);

        $hotelRoomService = new HotelRoomService(
            $hotelRoomRepository->reveal(),
            $hotelRepository->reveal(),
            $bookingRepository->reveal()
        );

        $hotelRoomService->add(
            'HOTEL-ID',
            1,
            'Short description',
            [
                ['name' => 'Room 1', 'length' => 28],
                ['name' => 'Room 2', 'length' => 32],
            ]
        );
    }

    public function testHotelRoomServiceBooksHotelRoomCorrectly()
    {
        $booking = $this->prophesize(HotelRoomBooking::class);

        $hotelRoom = $this->prophesize(HotelRoom::class);
        $hotelRoom->book(Argument::type('string'), Argument::type(Collection::class))
            ->willReturn($booking->reveal());

        $hotelRoomRepository = $this->prophesize(HotelRoomRepository::class);
        $hotelRoomRepository->findOneById(Argument::type('string'))
            ->willReturn($hotelRoom->reveal())
            ->shouldBeCalled();

        $hotelRepository = $this->prophesize(HotelRepository::class);

        $bookingRepository = $this->prophesize(BookingRepository::class);
        $bookingRepository->save(Argument::type(HotelRoomBooking::class))
            ->shouldBeCalled();

        $hotelRoomService = new HotelRoomService(
            $hotelRoomRepository->reveal(),
            $hotelRepository->reveal(),
            $bookingRepository->reveal()
        );

        $days = ['2020-01-01', '2020-01-03', '2020-01-04'];

        $hotelRoomBooked = $hotelRoomService->book(
            'EXAMPLE-ID',
            'TENANT-ID',
            $days
        );

        $this->assertEquals(HotelRoomBooked::class, get_class($hotelRoomBooked));
        $this->assertEquals('EXAMPLE-ID', $hotelRoomBooked->getHotelRoomId());
        $this->assertEquals('TENANT-ID', $hotelRoomBooked->getTenantId());
        $this->assertIsArray($hotelRoomBooked->getDays());
        $this->assertEquals($days, $hotelRoomBooked->getDays());
        $this->assertCount(3, $hotelRoomBooked->getDays());
    }
}
