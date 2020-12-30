<?php

namespace Rental\Infrastructure\Factory;

use Doctrine\ORM\EntityManager;
use Laminas\ServiceManager\Factory\FactoryInterface;
use Psr\Container\ContainerInterface;
use Rental\Application\Service\HotelRoomService;
use Rental\Domain\Hotel\HotelRoom;
use Rental\Domain\Hotel\Hotel;
use Rental\Domain\Hotel\HotelRoomRepository;
use Rental\Domain\Hotel\HotelRepository;

class HotelRoomServiceFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null): HotelRoomService
    {
        /** @var HotelRoomRepository $hotelRoomRepository */
        $hotelRoomRepository = $container->get(EntityManager::class)->getRepository(HotelRoom::class);

        /** @var HotelRepository $hotelRoomRepository */
        $hotelRepository = $container->get(EntityManager::class)->getRepository(Hotel::class);

        return new HotelRoomService($hotelRoomRepository, $hotelRepository);
    }
}