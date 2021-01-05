<?php

namespace Rental\Domain\Hotel;

interface HotelRepository
{
    public function save(Hotel $hotel): void;

    public function findOneById(string $id): Hotel;
}
