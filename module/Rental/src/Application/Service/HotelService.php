<?php

namespace Rental\Application\Service;

use Rental\Domain\Hotel\HotelFactory;
use Rental\Domain\Hotel\HotelRepository;

class HotelService
{
    private HotelRepository $hotelRepository;

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

        $this->hotelRepository->save($hotel);
    }
}