<?php

namespace Rental\Domain\Booking;

use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Rental\Domain\Apartment\Apartment;

/**
 * @ORM\Entity
 */
class ApartmentBooking extends Booking
{
    /**
     * @ORM\ManyToOne(targetEntity="Rental\Domain\Apartment\Apartment", inversedBy="bookings")
     */
    private Apartment $apartment;

    public function __construct(Apartment $apartment, string $tenantId, Collection $days)
    {
        $this->apartment = $apartment;
        parent::__construct($tenantId, $days);
    }
}