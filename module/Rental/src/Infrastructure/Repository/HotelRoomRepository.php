<?php

namespace Rental\Infrastructure\Repository;

use Doctrine\ORM\EntityRepository;
use Rental\Domain\Hotel\HotelRoom;
use Rental\Domain\Hotel\HotelRoomRepository as HotelRoomRepositoryInterface;

class HotelRoomRepository extends EntityRepository implements HotelRoomRepositoryInterface
{
    public function save(HotelRoom $hotelRoom): void
    {
        $this->getEntityManager()->persist($hotelRoom);
        $this->getEntityManager()->flush();
    }
}