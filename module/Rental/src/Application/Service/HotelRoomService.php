<?php

namespace Rental\Application\Service;

use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Rental\Domain\Booking\BookingDay;
use Rental\Domain\Booking\BookingRepository;
use Rental\Domain\Hotel\HotelRepository;
use Rental\Domain\Hotel\HotelRoomBooked;
use Rental\Domain\Hotel\HotelRoomRepository;
use Rental\Domain\Hotel\HotelRoomFactory;

class HotelRoomService
{
    private HotelRoomRepository $hotelRoomRepository;

    private HotelRepository $hotelRepository;

    private BookingRepository $bookingRepository;

    public function __construct(
        HotelRoomRepository $hotelRoomRepository,
        HotelRepository $hotelRepository,
        BookingRepository $bookingRepository
    ) {
        $this->hotelRoomRepository = $hotelRoomRepository;
        $this->hotelRepository = $hotelRepository;
        $this->bookingRepository = $bookingRepository;
    }

    public function add(
        string $hotelId,
        int $number,
        string $description,
        array $spaces
    ): void {
        $hotel = $this->hotelRepository->findOneById($hotelId);
        $hotelRoom = (new HotelRoomFactory())->create(
            $hotel,
            $number,
            $description,
            $spaces
        );

        $this->hotelRoomRepository->save($hotelRoom);
    }

    public function book(string $id, string $tenantId, array $days): HotelRoomBooked
    {
        $hotelRoom = $this->hotelRoomRepository->findOneById($id);
        $daysCollection = new ArrayCollection(
            array_map(function (string $day) {
                $date = new DateTime($day);
                return new BookingDay($date);
            }, $days)
        );
        $booking = $hotelRoom->book($tenantId, $daysCollection);

        $this->bookingRepository->save($booking);

        return new HotelRoomBooked($id, $tenantId, $days);
    }
}
