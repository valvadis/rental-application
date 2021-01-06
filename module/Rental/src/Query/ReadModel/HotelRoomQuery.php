<?php

namespace Rental\Query\ReadModel;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(readOnly=true)
 * @ORM\Table(name="HotelRoom")
 */
class HotelRoomQuery
{
    /**
     * @ORM\Id
     * @ORM\Column(name="id", type="guid")
     */
    private string $id;

    /**
     * @ORM\ManyToOne(targetEntity="HotelQuery")
     */
    private HotelQuery $hotel;

    /**
     * @ORM\Column(type="integer")
     */
    private int $number;

    /**
     * @ORM\Column(type="string")
     */
    private string $description;
}
