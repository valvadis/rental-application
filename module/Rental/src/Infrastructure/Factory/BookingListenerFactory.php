<?php

namespace Rental\Infrastructure\Factory;

use Doctrine\ORM\EntityManager;
use Laminas\ServiceManager\Factory\FactoryInterface;
use Psr\Container\ContainerInterface;
use Rental\Domain\Booking\BookingHistory;
use Rental\Domain\Booking\BookingHistoryRepository;
use Rental\Infrastructure\Listener\BookingListener;

class BookingListenerFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null): BookingListener
    {
        /** @var BookingHistoryRepository $bookingHistoryRepository */
        $bookingHistoryRepository = $container->get(EntityManager::class)->getRepository(BookingHistory::class);

        return new BookingListener($bookingHistoryRepository);
    }
}
