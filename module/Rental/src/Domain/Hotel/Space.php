<?php

namespace Rental\Domain\Hotel;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class Space
{
    /**
     * @ORM\Id
     * @ORM\Column(name="id", type="guid")
     * @ORM\GeneratedValue(strategy="UUID")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="HotelRoom", inversedBy="spaces")
     */
    private string $hotelRoom;

    /**
     * @ORM\Column(type="string")
     */
    private string $name;

    /**
     * @ORM\Column(type="decimal")
     */
    private float $length;

    public function __construct(string $name, float $length)
    {
        $this->name = $name;
        $this->length = $length;
    }
}