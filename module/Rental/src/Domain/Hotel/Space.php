<?php

namespace Rental\Domain\Hotel;

class Space
{
    private string $name;
    private float $length;

    public function __construct(string $name, float $length)
    {
        $this->name = $name;
        $this->length = $length;
    }
}