<?php

namespace Rental\Domain\Entity;

class Apartment
{
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