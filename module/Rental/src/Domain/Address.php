<?php

namespace Rental\Domain;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Embeddable
 */
class Address
{
    /**
     * @ORM\Column(type="string")
     */
    private string $street;

    /**
     * @ORM\Column(type="string")
     */
    private string $postalCode;

    /**
     * @ORM\Column(type="string")
     */
    private string $houseNumber;

    /**
     * @ORM\Column(type="string")
     */
    private string $apartmentNumber;

    /**
     * @ORM\Column(type="string")
     */
    private string $city;

    /**
     * @ORM\Column(type="string")
     */
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