<?php

namespace RentalTest\Unit\Application;

use Doctrine\Common\Collections\Collection;
use PHPUnit\Framework\TestCase;
use Prophecy\Argument;
use Rental\Application\Service\ApartmentService;
use Rental\Domain\Apartment\Apartment;
use Rental\Domain\Apartment\ApartmentBooked;
use Rental\Domain\Apartment\ApartmentRepository;
use Rental\Domain\Booking\ApartmentBooking;
use Rental\Domain\Booking\BookingRepository;
use Rental\Domain\Period;

class ApartmentServiceTest extends TestCase
{
    public function testApartmentServiceAddsApartmentCorrectly()
    {
        $apartmentRepository = $this->prophesize(ApartmentRepository::class);
        $apartmentRepository->save(Argument::type(Apartment::class))
            ->shouldBeCalled();

        $bookingRepository = $this->prophesize(BookingRepository::class);

        $apartmentService = new ApartmentService(
            $apartmentRepository->reveal(),
            $bookingRepository->reveal()
        );

        $apartmentService->add(
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
    }

    public function testApartmentServiceBooksApartmentCorrectly()
    {
        $booking = $this->prophesize(ApartmentBooking::class);

        $apartment = $this->prophesize(Apartment::class);
        $apartment->book(Argument::type('string'), Argument::type(Collection::class))
            ->willReturn($booking->reveal());

        $apartmentRepository = $this->prophesize(ApartmentRepository::class);
        $apartmentRepository->findOneById(Argument::type('string'))
            ->willReturn($apartment->reveal())
            ->shouldBeCalled();

        $bookingRepository = $this->prophesize(BookingRepository::class);
        $bookingRepository->save(Argument::type(ApartmentBooking::class))
            ->shouldBeCalled();

        $apartmentService = new ApartmentService(
            $apartmentRepository->reveal(),
            $bookingRepository->reveal()
        );

        $start = new \DateTime('2020-01-01');
        $end = new \DateTime('2020-01-05');

        $apartmentBooked = $apartmentService->book(
            'EXAMPLE-ID',
            'TENANT-ID',
            $start,
            $end
        );

        $this->assertEquals(ApartmentBooked::class, get_class($apartmentBooked));
        $this->assertEquals('EXAMPLE-ID', $apartmentBooked->getApartmentId());
        $this->assertEquals('TENANT-ID', $apartmentBooked->getTenantId());
        $this->assertEquals(Period::class, get_class($apartmentBooked->getPeriod()));
        $this->assertEquals($start, $apartmentBooked->getPeriod()->getStart());
        $this->assertEquals($end, $apartmentBooked->getPeriod()->getEnd());
    }
}
