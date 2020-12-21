<?php

namespace Rental\Application\Service;

use Rental\Domain\Factory\HotelFactory;

class HotelService
{
    public function add(
        string $name,
        string $street,
        string $postalCode,
        string $houseNumber,
        string $apartmentNumber,
        string $city,
        string $country
    ): void {
        $hotel = (new HotelFactory)->create(
            $name,
            $street,
            $postalCode,
            $houseNumber,
            $apartmentNumber,
            $city,
            $country
        );
    }
}