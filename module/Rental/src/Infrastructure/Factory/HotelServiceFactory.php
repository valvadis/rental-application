<?php

namespace Rental\Infrastructure\Factory;

use Doctrine\ORM\EntityManager;
use Laminas\ServiceManager\Factory\FactoryInterface;
use Psr\Container\ContainerInterface;
use Rental\Application\Service\HotelService;
use Rental\Domain\Hotel\Hotel;
use Rental\Domain\Hotel\HotelRepository;

class HotelServiceFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null): HotelService
    {
        /** @var HotelRepository $hotelRepository */
        $hotelRepository = $container->get(EntityManager::class)->getRepository(Hotel::class);

        return new HotelService($hotelRepository);
    }
}
