<?php

namespace Rental\Domain\Hotel;

class HotelRoomFactory
{
    public function create(
        string $hotelId,
        int $number,
        string $description,
        array $spaces
    ): HotelRoom {
        $spaces = array_map(function ($name, $length) {
            return new Space($name, $length);
        }, $spaces);

        return new HotelRoom($hotelId, $number, $description, $spaces);
    }
}