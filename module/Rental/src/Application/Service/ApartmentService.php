<?php

namespace Rental\Application\Service;

use Rental\Domain\Apartment\ApartmentFactory;
use Rental\Domain\Apartment\ApartmentRepository;
use Rental\Domain\Apartment\BookingRepository;
use Rental\Domain\Period;

class ApartmentService
{
    private ApartmentRepository $apartmentRepository;

    private BookingRepository $bookingRepository;

    public function __construct(ApartmentRepository $apartmentRepository, BookingRepository $bookingRepository)
    {
        $this->apartmentRepository = $apartmentRepository;
        $this->bookingRepository = $bookingRepository;
    }

    public function add(
        string $ownerId,
        string $street,
        string $postalCode,
        string $houseNumber,
        string $apartmentNumber,
        string $city,
        string $country,
        string $description,
        array $rooms
    ): void {
        $apartment = (new ApartmentFactory)->create(
            $ownerId,
            $street,
            $postalCode,
            $houseNumber,
            $apartmentNumber,
            $city,
            $country,
            $description,
            $rooms
        );

        $this->apartmentRepository->save($apartment);
    }

    public function book(string $id, string $tenantId, \DateTime $start, \DateTime $end): void
    {
        $apartment = $this->apartmentRepository->findOneById($id);
        $period = new Period($start, $end);
        $booking = $apartment->book($tenantId, $period);

        $this->bookingRepository->save($booking);
    }
}
