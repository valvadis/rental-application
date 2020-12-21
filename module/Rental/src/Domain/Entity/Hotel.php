<?php

namespace Rental\Domain\Entity;

class Hotel
{
    private string $name;
    private Address $address;

    public function __construct(string $name, Address $address)
    {
        $this->name = $name;
        $this->address = $address;
    }
}