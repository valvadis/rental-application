<?php

namespace Rental\Domain\Apartment;

use Doctrine\Common\Collections\ArrayCollection;
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
        $rooms = array_map(function (array $room) {
            return new ApartmentRoom($room['name'], $room['size']);
        }, $rooms);

        return new Apartment($ownerId, $address, $description, new ArrayCollection($rooms));
    }
}
