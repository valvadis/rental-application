<?php

namespace Rental\Domain\Factory;

use Rental\Domain\Entity;

class HotelFactory
{
    public function create(
        string $name,
        string $street,
        string $postalCode,
        string $houseNumber,
        string $apartmentNumber,
        string $city,
        string $country
    ): Entity\Hotel {
        $address = new Entity\Address($street, $postalCode, $houseNumber, $apartmentNumber, $city, $country);
        return new Entity\Hotel($name, $address);
    }
}