<?php

namespace Rental\Infrastructure\Repository;

use Doctrine\ORM\EntityRepository;
use Rental\Domain\Hotel\HotelRoom;
use Rental\Domain\Hotel\HotelRoomRepository as HotelRoomRepositoryInterface;
use Rental\Domain\Hotel\Space;

class HotelRoomRepository extends EntityRepository implements HotelRoomRepositoryInterface
{
    public function save(HotelRoom $hotelRoom): void
    {
        /** @var Space $space */
        foreach ($hotelRoom->getSpaces() as $space) {
            $space->setHotelRoom($hotelRoom);
        }

        $this->getEntityManager()->persist($hotelRoom);
        $this->getEntityManager()->flush();
    }
}