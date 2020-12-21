<?php

namespace Rental\Domain\Entity;

class ApartmentRoom
{
    private string $name;
    private float $size;

    public function __construct(string $name, float $size)
    {
        $this->name = $name;
        $this->size = $size;
    }
}