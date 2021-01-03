<?php

namespace Rental\Domain\Apartment;

use Doctrine\ORM\Mapping as ORM;
use Rental\Domain\Period;

/**
 * @ORM\Entity(repositoryClass="Rental\Infrastructure\Repository\BookingRepository")
 */
class Booking
{
    /**
     * @ORM\Id
     * @ORM\Column(name="id", type="guid")
     * @ORM\GeneratedValue(strategy="UUID")
     */
    private string $id;

    /**
     * @ORM\ManyToOne(targetEntity="Apartment", inversedBy="bookings")
     */
    private Apartment $apartment;

    /**
     * @ORM\Column(type="string")
     */
    private string $tenantId;

    /**
     * @ORM\Embedded(class="Rental\Domain\Period", columnPrefix=false)
     */
    private Period $period;

    public function __construct(Apartment $apartment, string $tenantId, Period $period)
    {
        $this->apartment = $apartment;
        $this->tenantId = $tenantId;
        $this->period = $period;
    }
}