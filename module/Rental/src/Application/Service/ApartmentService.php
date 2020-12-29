<?php

namespace Rental\Application\Service;

use Rental\Domain\Apartment\ApartmentFactory;
use Rental\Domain\Apartment\ApartmentRepository;

class ApartmentService
{
    private ApartmentRepository $apartmentRepository;

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
}