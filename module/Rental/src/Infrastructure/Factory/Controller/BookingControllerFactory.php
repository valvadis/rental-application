<?php

namespace Rental\Infrastructure\Factory\Controller;

use Doctrine\ORM\EntityManager;
use Laminas\ServiceManager\Factory\FactoryInterface;
use Psr\Container\ContainerInterface;
use Rental\Infrastructure\CommandBus\CommandBus;
use Rental\Infrastructure\Controller\BookingController;
use Rental\Query\ReadModel\BookingQuery;
use Rental\Query\Repository\BookingQueryRepository;

class BookingControllerFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null): BookingController
    {
        /** @var CommandBus $commandBus */
        $commandBus = $container->get(CommandBus::class);

        /** @var BookingQueryRepository $hotelQueryRepository */
        $bookingQueryRepository = $container->get(EntityManager::class)->getRepository(BookingQuery::class);

        return new BookingController($commandBus, $bookingQueryRepository);
    }
}
