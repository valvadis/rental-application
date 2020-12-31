<?php

namespace Rental\Application\Service;

use Rental\Domain\Apartment\ApartmentBooked;
use Rental\Domain\Hotel\HotelRepository;
use Rental\Domain\Hotel\HotelRoomRepository;
use Rental\Domain\Hotel\HotelRoomFactory;
use Rental\Domain\Period;

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

    public function book(string $id, string $tenantId, string $start, string $end): ApartmentBooked
    {
        $hotelRoom = $this->hotelRoomRepository->findOneById($id);
        $start = new \DateTime($start);
        $end = new \DateTime($end);
        $period = new Period($start, $end);

        return $hotelRoom->book($tenantId, $period);
    }
}