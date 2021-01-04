<?php

namespace Rental\Infrastructure\Factory;

use Doctrine\ORM\EntityManager;
use Laminas\ServiceManager\Factory\FactoryInterface;
use Psr\Container\ContainerInterface;
use Rental\Application\Handler\BookingRejectHandler;
use Rental\Domain\Booking\Booking;
use Rental\Domain\Booking\BookingRepository;

class BookingRejectHandlerFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null): BookingRejectHandler
    {
        /** @var BookingRepository $bookingRepository */
        $bookingRepository = $container->get(EntityManager::class)->getRepository(Booking::class);

        return new BookingRejectHandler($bookingRepository);
    }
}