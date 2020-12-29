<?php

namespace Rental\Domain\Apartment;

use Rental\Domain\Address;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 * @ORM\Table(name="apartment")
 */
class Apartment
{
    /**
     * @ORM\Id
     * @ORM\Column(name="ownerId", type="guid")
     * @ORM\GeneratedValue(strategy="UUID")
     */
    private string $ownerId;

    private Address $address;
    private string $description;
    private array $rooms;

    public function __construct(string $ownerId, Address $address, string $description, array $rooms)
    {
        $this->ownerId = $ownerId;
        $this->address = $address;
        $this->description = $description;
        $this->rooms = $rooms;
    }
}