<?php

namespace Rental\Domain\Apartment;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class ApartmentRoom
{
    /**
     * @ORM\Id
     * @ORM\Column(name="id", type="guid")
     * @ORM\GeneratedValue(strategy="UUID")
     */
    private string $id;

    /**
     * @ORM\ManyToOne(targetEntity="Apartment", inversedBy="rooms")
     */
    private Apartment $apartment;

    /**
     * @ORM\Column(type="string")
     */
    private string $name;

    /**
     * @ORM\Column(type="decimal")
     */
    private float $size;

    public function __construct(string $name, float $size)
    {
        $this->name = $name;
        $this->size = $size;
    }

    public function setApartment(Apartment $apartment): void
    {
        $this->apartment = $apartment;
    }
}