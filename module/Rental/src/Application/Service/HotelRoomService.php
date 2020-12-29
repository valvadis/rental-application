<?php

namespace Rental\Application\Service;

use Rental\Domain\Hotel\HotelRoomRepository;
use Rental\Domain\Hotel\HotelRoomFactory;

class HotelRoomService
{
    private HotelRoomRepository $hotelRepository;

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

        $this->hotelRepository->save($hotelRoom);
    }
}