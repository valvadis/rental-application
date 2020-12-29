<?php

namespace Rental\Domain\Apartment;

interface ApartmentRepository
{
    public function save(Apartment $apartment): void;
}