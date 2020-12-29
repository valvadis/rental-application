<?php

namespace Rental\Domain\Hotel;

use Rental\Domain\Address;

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
    ): Hotel {
        $address = new Address($street, $postalCode, $houseNumber, $apartmentNumber, $city, $country);

        return new Hotel($name, $address);
    }
}