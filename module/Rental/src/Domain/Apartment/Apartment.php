<?php

namespace Rental\Domain\Apartment;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Rental\Domain\Address;
use Doctrine\ORM\Mapping as ORM;
use Rental\Domain\Booking\ApartmentBooking;
use Rental\Domain\Period;

/**
 * @ORM\Entity(repositoryClass="Rental\Infrastructure\Repository\ApartmentRepository")
 */
class Apartment
{
    /**
     * @ORM\Id
     * @ORM\Column(name="id", type="guid")
     * @ORM\GeneratedValue(strategy="UUID")
     */
    private string $id;

    /**
     * @ORM\Column(type="string")
     */
    private string $ownerId;

    /**
     * @ORM\Embedded(class="Rental\Domain\Address", columnPrefix=false)
     */
    private Address $address;

    /**
     * @ORM\Column(type="string")
     */
    private string $description;

    /**
     * @ORM\OneToMany(targetEntity="ApartmentRoom", mappedBy="apartment", cascade="persist")
     */
    private Collection $rooms;

    /**
     * @ORM\OneToMany(targetEntity="Rental\Domain\Booking\ApartmentBooking", mappedBy="apartment", cascade="persist")
     */
    private Collection $bookings;

    public function __construct(string $ownerId, Address $address, string $description, Collection $rooms)
    {
        $this->ownerId = $ownerId;
        $this->address = $address;
        $this->description = $description;
        $this->rooms = $rooms;
        $this->bookings = new ArrayCollection();
    }

    public function getRooms(): Collection
    {
        return $this->rooms;
    }

    public function book(string $tenantId, Period $period): ApartmentBooking
    {
        $booking = new ApartmentBooking($this, $tenantId, new ArrayCollection($period->asDays()));
        $this->bookings->add($booking);

        return $booking;
    }
}
