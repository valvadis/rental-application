<?php

namespace Rental\Infrastructure\Factory\Controller;

use Doctrine\ORM\EntityManager;
use Laminas\ServiceManager\Factory\FactoryInterface;
use Psr\Container\ContainerInterface;
use Rental\Application\Service\ApartmentService;
use Rental\Infrastructure\Controller\ApartmentController;
use Rental\Query\ReadModel\ApartmentQuery;
use Rental\Query\Repository\ApartmentQueryRepository;

class ApartmentControllerFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null): ApartmentController
    {
        /** @var ApartmentService $apartmentService */
        $apartmentService = $container->get(ApartmentService::class);

        /** @var ApartmentQueryRepository $apartmentQueryRepository */
        $apartmentQueryRepository = $container->get(EntityManager::class)->getRepository(ApartmentQuery::class);

        return new ApartmentController($apartmentService, $apartmentQueryRepository);
    }
}
