<?php

namespace Rental\Query\ReadModel;

use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(readOnly=true, repositoryClass="Rental\Query\Repository\HotelQueryRepository")
 * @ORM\Table(name="Hotel")
 */
class HotelQuery
{
    /**
     * @ORM\Id
     * @ORM\Column(name="id", type="guid")
     */
    private string $id;

    /**
     * @ORM\OneToMany(targetEntity="HotelRoomQuery", mappedBy="hotel")
     */
    private Collection $rooms;

    /**
     * @ORM\Column(type="string")
     */
    private string $name;

    /**
     * @ORM\Column(type="string")
     */
    private string $street;

    /**
     * @ORM\Column(type="string")
     */
    private string $postalCode;

    /**
     * @ORM\Column(type="string")
     */
    private string $houseNumber;

    /**
     * @ORM\Column(type="string")
     */
    private string $apartmentNumber;

    /**
     * @ORM\Column(type="string")
     */
    private string $city;

    /**
     * @ORM\Column(type="string")
     */
    private string $country;
}
