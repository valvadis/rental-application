<?php

namespace Rental\Domain\Hotel;

use Rental\Domain\Address;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="Rental\Infrastructure\Repository\HotelRepository")
 */
class Hotel
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
    private string $name;

    /**
     * @ORM\Embedded(class="Rental\Domain\Address", columnPrefix=false)
     */
    private Address $address;

    public function __construct(string $name, Address $address)
    {
        $this->name = $name;
        $this->address = $address;
    }
}