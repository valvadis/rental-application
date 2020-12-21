<?php

namespace Rental\Application\Service;

use Rental\Domain\Factory\ApartmentFactory;

class ApartmentService
{
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
    }
}