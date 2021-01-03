<?php

namespace Rental\Domain\Booking;

use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="Rental\Infrastructure\Repository\BookingRepository")
 * @ORM\InheritanceType("SINGLE_TABLE")
 * @ORM\DiscriminatorColumn(name="rentalType", type="string")
 * @ORM\DiscriminatorMap({ "apartment" = "ApartmentBooking", "hotel" = "HotelRoomBooking"})
 */
abstract class Booking
{
    /**
     * @ORM\Id
     * @ORM\Column(name="id", type="guid")
     * @ORM\GeneratedValue(strategy="UUID")
     */
    protected string $id;

    /**
     * @ORM\Column(type="string")
     */
    protected string $tenantId;

    /**
     * @ORM\OneToMany(targetEntity="BookingDay", mappedBy="booking", cascade="persist")
     */
    protected Collection $days;

    public function __construct(string $tenantId, Collection $days)
    {
        $this->tenantId = $tenantId;
        $this->days = $days;
    }

    public function getDays(): Collection
    {
        return $this->days;
    }
}