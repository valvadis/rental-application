<?php

namespace Rental\Query\ReadModel;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(readOnly=true)
 * @ORM\Table(name="ApartmentRoom")
 */
class ApartmentRoomQuery
{
    /**
     * @ORM\Id
     * @ORM\Column(name="id", type="guid")
     */
    private string $id;

    /**
     * @ORM\ManyToOne(targetEntity="ApartmentQuery", inversedBy="rooms")
     */
    private ApartmentQuery $apartment;

    /**
     * @ORM\Column(type="string")
     */
    private string $name;

    /**
     * @ORM\Column(type="decimal")
     */
    private float $size;
}
