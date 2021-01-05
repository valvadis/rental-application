<?php

namespace Rental\Infrastructure\Factory;

use Doctrine\ORM\EntityManager;
use Laminas\ServiceManager\Factory\FactoryInterface;
use Psr\Container\ContainerInterface;
use Rental\Application\Service\ApartmentService;
use Rental\Domain\Apartment\Apartment;
use Rental\Domain\Apartment\ApartmentRepository;
use Rental\Domain\Booking\Booking;
use Rental\Domain\Booking\BookingRepository;

class ApartmentServiceFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null): ApartmentService
    {
        /** @var ApartmentRepository $apartmentRepository */
        $apartmentRepository = $container->get(EntityManager::class)->getRepository(Apartment::class);

        /** @var BookingRepository $bookingRepository */
        $bookingRepository = $container->get(EntityManager::class)->getRepository(Booking::class);

        return new ApartmentService($apartmentRepository, $bookingRepository);
    }
}
