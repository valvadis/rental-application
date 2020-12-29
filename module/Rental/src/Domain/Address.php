<?php

namespace Rental\Domain;

class Address
{
    private string $street;
    private string $postalCode;
    private string $houseNumber;
    private string $apartmentNumber;
    private string $city;
    private string $country;

    public function __construct(
        string $street,
        string $postalCode,
        string $houseNumber,
        string $apartmentNumber,
        string $city,
        string $country
    ) {
        $this->street = $street;
        $this->postalCode = $postalCode;
        $this->houseNumber = $houseNumber;
        $this->apartmentNumber = $apartmentNumber;
        $this->city = $city;
        $this->country = $country;
    }
}