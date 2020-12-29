<?php

namespace Rental\Domain\Hotel;

use Rental\Domain\Address;

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