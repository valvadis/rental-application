<?php

namespace Rental\Domain\Booking;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class BookingDay
{
    /**
     * @ORM\Id
     * @ORM\Column(name="id", type="guid")
     * @ORM\GeneratedValue(strategy="UUID")
     */
    protected string $id;

    /**
     * @ORM\Column(type="date")
     */
    protected \DateTime $day;

    /**
     * @ORM\ManyToOne(targetEntity="Booking", inversedBy="days")
     */
    protected Booking $booking;

    public function __construct(\DateTime $day)
    {
        $this->day = $day;
    }

    /**
     * @param Booking $booking
     */
    public function setBooking(Booking $booking): void
    {
        $this->booking = $booking;
    }
}