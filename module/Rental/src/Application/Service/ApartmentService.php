<?php

namespace Rental\Application\Service;

use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Rental\Domain\Apartment\ApartmentBooked;
use Rental\Domain\Apartment\ApartmentFactory;
use Rental\Domain\Apartment\ApartmentRepository;
use Rental\Domain\Booking\BookingDay;
use Rental\Domain\Booking\BookingRepository;
use Rental\Domain\Period;

class ApartmentService
{
    private ApartmentRepository $apartmentRepository;

    private BookingRepository $bookingRepository;

    public function __construct(ApartmentRepository $apartmentRepository, BookingRepository $bookingRepository)
    {
        $this->apartmentRepository = $apartmentRepository;
        $this->bookingRepository = $bookingRepository;
    }

    public function add(
        string $ownerId,
        string $street,
        string $postalCode,
        string $houseNumber,
        string $apartmentNumber,
        string $city,
        string $country,
        string $description,
        array $rooms
    ): void {
        $apartment = (new ApartmentFactory())->create(
            $ownerId,
            $street,
            $postalCode,
            $houseNumber,
            $apartmentNumber,
            $city,
            $country,
            $description,
            $rooms
        );

        $this->apartmentRepository->save($apartment);
    }

    public function book(string $id, string $tenantId, \DateTime $start, \DateTime $end): ApartmentBooked
    {
        $apartment = $this->apartmentRepository->findOneById($id);
        $period = new Period($start, $end);
        $daysCollection = new ArrayCollection(
            array_map(function (DateTime $day) {
                return new BookingDay($day);
            }, $period->asDays())
        );
        $booking = $apartment->book($tenantId, $daysCollection);

        $this->bookingRepository->save($booking);

        return new ApartmentBooked($id, $tenantId, $period);
    }
}
