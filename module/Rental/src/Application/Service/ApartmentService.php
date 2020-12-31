<?php

namespace Rental\Application\Service;

use Rental\Domain\Apartment\ApartmentBooked;
use Rental\Domain\Apartment\ApartmentFactory;
use Rental\Domain\Apartment\ApartmentRepository;
use Rental\Domain\Period;

class ApartmentService
{
    private ApartmentRepository $apartmentRepository;

    public function __construct(ApartmentRepository $apartmentRepository)
    {
        $this->apartmentRepository = $apartmentRepository;
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

    public function book(string $id, string $tenantId, string $start, string $end): ApartmentBooked
    {
        $apartment = $this->apartmentRepository->findOneById($id);
        $start = new \DateTime($start);
        $end = new \DateTime($end);
        $period = new Period($start, $end);

        return $apartment->book($tenantId, $period);
    }
}
