<?php

namespace Rental\Query\ReadModel;

use DateTime;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(readOnly=true)
 * @ORM\Table(name="BookingDay")
 */
class BookingDayQuery
{
    /**
     * @ORM\Id
     * @ORM\Column(name="id", type="guid")
     */
    private string $id;

    /**
     * @ORM\ManyToOne(targetEntity="BookingQuery", inversedBy="bookingDays")
     */
    private BookingQuery $booking;

    /**
     * @ORM\Column(type="date")
     */
    private DateTime $day;
}
