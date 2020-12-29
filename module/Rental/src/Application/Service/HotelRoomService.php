<?php

namespace Rental\Application\Service;

use Rental\Domain\Hotel\HotelRoomRepository;
use Rental\Domain\Hotel\HotelRoomFactory;

class HotelRoomService
{
    private HotelRoomRepository $hotelRoomRepository;

    public function __construct(HotelRoomRepository $hotelRoomRepository)
    {
        $this->hotelRoomRepository = $hotelRoomRepository;
    }

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

        $this->hotelRoomRepository->save($hotelRoom);
    }
}