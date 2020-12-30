<?php

namespace Rental\Domain\Hotel;

use Doctrine\Common\Collections\ArrayCollection;

class HotelRoomFactory
{
    public function create(
        Hotel $hotel,
        int $number,
        string $description,
        array $spaces
    ): HotelRoom {
        $spaces = array_map(function (array $space) {
            return new Space($space['name'], $space['length']);
        }, $spaces);

        return new HotelRoom($hotel, $number, $description, new ArrayCollection($spaces));
    }
}