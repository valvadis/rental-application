<?php

namespace Rental\Domain\Factory;

use Rental\Domain\Entity;

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
    ): Entity\Apartment {
        $address = new Entity\Address($street, $postalCode, $houseNumber, $apartmentNumber, $city, $country);
        $rooms = array_map(function (string $name, float $size) {
            return new Entity\ApartmentRoom($name, $size);
        }, $rooms);
        return new Entity\Apartment($ownerId, $address, $description, $rooms);
    }
}