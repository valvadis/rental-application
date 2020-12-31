<?php

namespace Rental\Domain\Apartment;

use Doctrine\Common\Collections\Collection;
use Rental\Domain\Address;
use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\Uuid;
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

    public function __construct(string $ownerId, Address $address, string $description, Collection $rooms)
    {
        $this->ownerId = $ownerId;
        $this->address = $address;
        $this->description = $description;
        $this->rooms = $rooms;
    }

    public function getRooms(): Collection
    {
        return $this->rooms;
    }

    public function book(string $tenantId, Period $period): ApartmentBooked
    {
        return ApartmentBooked::create(
            $tenantId,
            $this->ownerId,
            $this->id,
            $period
        );
    }
}