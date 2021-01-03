<?php

namespace Rental\Domain\Booking;

use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Rental\Domain\Hotel\HotelRoom;

/**
 * @ORM\Entity
 */
class HotelRoomBooking extends Booking
{
    /**
     * @ORM\ManyToOne(targetEntity="Rental\Domain\Hotel\HotelRoom", inversedBy="bookings")
     */
    private HotelRoom $hotelRoom;

    public function __construct(HotelRoom $hotelRoom, string $tenantId, Collection $days)
    {
        $this->hotelRoom = $hotelRoom;
        parent::__construct($tenantId, $days);
    }
}