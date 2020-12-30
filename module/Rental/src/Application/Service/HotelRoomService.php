<?php

namespace Rental\Application\Service;

use Rental\Domain\Hotel\HotelRepository;
use Rental\Domain\Hotel\HotelRoomRepository;
use Rental\Domain\Hotel\HotelRoomFactory;

class HotelRoomService
{
    private HotelRoomRepository $hotelRoomRepository;

    private HotelRepository $hotelRepository;

    public function __construct(HotelRoomRepository $hotelRoomRepository, HotelRepository $hotelRepository)
    {
        $this->hotelRoomRepository = $hotelRoomRepository;
        $this->hotelRepository = $hotelRepository;
    }

    public function add(
        string $hotelId,
        int $number,
        string $description,
        array $spaces
    ): void {
        $hotel = $this->hotelRepository->findOneById($hotelId);
        $hotelRoom = (new HotelRoomFactory)->create(
            $hotel,
            $number,
            $description,
            $spaces
        );

        $this->hotelRoomRepository->save($hotelRoom);
    }
}