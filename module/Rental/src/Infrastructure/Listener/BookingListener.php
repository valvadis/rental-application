<?php

namespace Rental\Infrastructure\Listener;

use Laminas\EventManager\EventInterface;
use Laminas\EventManager\EventManagerInterface;
use Laminas\EventManager\ListenerAggregateTrait;
use Laminas\Json\Json;
use Rental\Domain\Apartment\ApartmentBooked;
use Rental\Domain\Booking\BookingHistory;
use Rental\Domain\Booking\BookingHistoryRepository;
use Rental\Domain\Hotel\HotelRoomBooked;
use Rental\Infrastructure\Controller\ApartmentController;
use Rental\Infrastructure\Controller\HotelRoomController;

class BookingListener
{
    use ListenerAggregateTrait;

    private const APARTMENT_TYPE = 'apartment';
    private const HOTEL_ROOM_TYPE = 'hotelRoom';

    private BookingHistoryRepository $bookingHistoryRepository;

    public function __construct(BookingHistoryRepository $bookingHistoryRepository)
    {
        $this->bookingHistoryRepository = $bookingHistoryRepository;
    }

    public function attach(EventManagerInterface $events, $priority = 1000)
    {
        $sharedManager = $events->getSharedManager();

        $this->listeners[] = $sharedManager->attach(
            ApartmentController::class,
            ApartmentBooked::class,
            [$this, 'apartmentBooked'],
            $priority
        );

        $this->listeners[] = $sharedManager->attach(
            HotelRoomController::class,
            HotelRoomBooked::class,
            [$this, 'hotelRoomBooked'],
            $priority
        );
    }

    public function apartmentBooked(EventInterface $event)
    {
        /** @var ApartmentBooked $apartmentBooked */
        $apartmentBooked = $event->getParams();
        $bookingHistory = new BookingHistory(
            $apartmentBooked->getApartmentId(),
            self::APARTMENT_TYPE,
            $apartmentBooked->getTenantId(),
            Json::encode($apartmentBooked->getPeriod()->asDays())
        );

        $this->bookingHistoryRepository->save($bookingHistory);
    }

    public function hotelRoomBooked(EventInterface $event)
    {

        /** @var HotelRoomBooked $hotelRoomBooked */
        $hotelRoomBooked = $event->getParams();
        $bookingHistory = new BookingHistory(
            $hotelRoomBooked->getHotelRoomId(),
            self::HOTEL_ROOM_TYPE,
            $hotelRoomBooked->getTenantId(),
            Json::encode($hotelRoomBooked->getDays())
        );

        $this->bookingHistoryRepository->save($bookingHistory);
    }
}
