<?php

namespace Rental\Application\Service;

use Rental\Domain\Factory\HotelRoomFactory;

class HotelRoomService
{
    public function add(
        string $hotelId,
        int $number,
        string $description,
        array $spaces
    ): void {
        $hotelRoom = (new HotelRoomFactory)->create(
            $hotelId,
            $number,
            $description,
            $spaces
        );
    }
}