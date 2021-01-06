<?php

namespace Rental\Infrastructure\Factory;

use Doctrine\ORM\EntityManager;
use Laminas\ServiceManager\Factory\FactoryInterface;
use Psr\Container\ContainerInterface;
use Rental\Application\Service\HotelService;
use Rental\Infrastructure\Controller\HotelController;
use Rental\Query\ReadModel\HotelQuery;
use Rental\Query\Repository\HotelQueryRepository;

class HotelControllerFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null): HotelController
    {
        /** @var HotelService $hotelService */
        $hotelService = $container->get(HotelService::class);

        /** @var HotelQueryRepository $hotelQueryRepository */
        $hotelQueryRepository = $container->get(EntityManager::class)->getRepository(HotelQuery::class);

        return new HotelController($hotelService, $hotelQueryRepository);
    }
}
