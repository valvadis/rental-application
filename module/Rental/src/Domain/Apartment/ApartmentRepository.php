<?php

namespace Rental\Domain\Apartment;

interface ApartmentRepository
{
    public function save(Apartment $apartment): void;

    public function findOneById(string $id): Apartment;
}
