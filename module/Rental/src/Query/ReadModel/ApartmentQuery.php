<?php

namespace Rental\Query\ReadModel;

use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(readOnly=true, repositoryClass="Rental\Query\Repository\ApartmentQueryRepository")
 * @ORM\Table(name="Apartment")
 */
class ApartmentQuery
{
    /**
     * @ORM\Id
     * @ORM\Column(name="id", type="guid")
     */
    private string $id;

    /**
     * @ORM\OneToMany(targetEntity="ApartmentRoomQuery", mappedBy="apartment")
     */
    private Collection $rooms;

    /**
     * @ORM\Column(type="string")
     */
    private string $ownerId;

    /**
     * @ORM\Column(type="string")
     */
    private string $description;

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
