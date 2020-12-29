<?php

namespace Rental\Domain\Hotel;

interface HotelRoomRepository
{
    public function save(HotelRoom $hotelRoom): void;
}