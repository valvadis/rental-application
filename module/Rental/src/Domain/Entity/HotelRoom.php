<?php

namespace Rental\Domain\Entity;

class HotelRoom
{
    private string $hotelId;
    private int $number;
    private string $description;
    private array $spaces;

    public function __construct(string $hotelId, int $number, string $description, array $spaces)
    {
        $this->hotelId = $hotelId;
        $this->number = $number;
        $this->description = $description;
        $this->spaces = $spaces;
    }
}