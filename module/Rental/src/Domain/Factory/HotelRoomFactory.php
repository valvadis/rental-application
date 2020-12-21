<?php

namespace Rental\Domain\Factory;

use Rental\Domain\Entity;

class HotelRoomFactory
{
    public function create(
        string $hotelId,
        int $number,
        string $description,
        array $spaces
    ): Entity\HotelRoom {
        $spaces = array_map(function ($name, $length) {
            return new Entity\Space($name, $length);
        }, $spaces);
        return new Entity\HotelRoom($hotelId, $number, $description, $spaces);
    }
}