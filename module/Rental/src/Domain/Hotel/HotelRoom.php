<?php

namespace Rental\Domain\Hotel;

use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="Rental\Infrastructure\Repository\HotelRoomRepository")
 */
class HotelRoom
{
    /**
     * @ORM\Id
     * @ORM\Column(name="id", type="guid")
     * @ORM\GeneratedValue(strategy="UUID")
     */
    private string $id;

    /**
     * @ORM\ManyToOne(targetEntity="Hotel")
    */
    private Hotel $hotel;

    /**
     * @ORM\Column(type="integer")
     */
    private int $number;

    /**
     * @ORM\Column(type="string")
     */
    private string $description;

    /**
     * @ORM\OneToMany(targetEntity="Space", mappedBy="hotelRoom")
    */
    private Collection $spaces;

    public function __construct(Hotel $hotel, int $number, string $description, Collection $spaces)
    {
        $this->hotel = $hotel;
        $this->number = $number;
        $this->description = $description;
        $this->spaces = $spaces;
    }
}