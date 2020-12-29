<?php

namespace Rental\Domain\Apartment;

use Rental\Domain\Address;

class ApartmentFactory
{
    public function create(
        string $ownerId,
        string $street,
        string $postalCode,
        string $houseNumber,
        string $apartmentNumber,
        string $city,
        string $country,
        string $description,
        array $rooms
    ): Apartment {
        $address = new Address($street, $postalCode, $houseNumber, $apartmentNumber, $city, $country);
        $rooms = array_map(function (string $name, float $size) {
            return new ApartmentRoom($name, $size);
        }, $rooms);

        return new Apartment($ownerId, $address, $description, $rooms);
    }
}