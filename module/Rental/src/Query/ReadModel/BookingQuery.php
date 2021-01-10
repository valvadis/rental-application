<?php

namespace Rental\Query\ReadModel;

use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(readOnly=true, repositoryClass="Rental\Query\Repository\BookingQueryRepository")
 * @ORM\Table(name="Booking")
 */
class BookingQuery
{
    /**
     * @ORM\Id
     * @ORM\Column(name="id", type="guid")
     */
    private string $id;

    /**
     * @ORM\ManyToOne(targetEntity="ApartmentQuery")
     */
    private ApartmentQuery $apartment;

    /**
     * @ORM\ManyToOne(targetEntity="HotelRoomQuery")
     */
    private HotelRoomQuery $hotelRoom;

    /**
     * @ORM\OneToMany(targetEntity="BookingDayQuery", mappedBy="booking")
     */
    private Collection $bookingDays;

    /**
     * @ORM\Column(type="string")
     */
    private string $tenantId;

    /**
     * @ORM\Column(type="string")
     */
    private string $rentalType;

    /**
     * @ORM\Column(type="string")
     */
    private string $status;
}
