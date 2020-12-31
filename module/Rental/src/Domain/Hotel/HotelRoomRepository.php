<?php

namespace Rental\Domain\Hotel;

interface HotelRoomRepository
{
    public function save(HotelRoom $hotelRoom): void;

    public function findOneById(string $id): HotelRoom;
}