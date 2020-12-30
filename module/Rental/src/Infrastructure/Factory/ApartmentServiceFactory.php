<?php

namespace Rental\Infrastructure\Factory;

use Doctrine\ORM\EntityManager;
use Laminas\ServiceManager\Factory\FactoryInterface;
use Psr\Container\ContainerInterface;
use Rental\Application\Service\ApartmentService;
use Rental\Domain\Apartment\Apartment;
use Rental\Domain\Apartment\ApartmentRepository;

class ApartmentServiceFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null): ApartmentService
    {
        /** @var ApartmentRepository $apartmentRepository */
        $apartmentRepository = $container->get(EntityManager::class)->getRepository(Apartment::class);

        return new ApartmentService($apartmentRepository);
    }
}