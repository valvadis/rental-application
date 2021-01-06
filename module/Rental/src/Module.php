<?php

namespace Rental;

use Laminas\Mvc\MvcEvent;
use Rental\Infrastructure\Listener\BookingListener;

class Module
{
    public function getConfig(): array
    {
        return include __DIR__ . '/../config/module.config.php';
    }

    public function onBootstrap(MvcEvent $event)
    {
        $serviceManager = $event->getApplication()->getServiceManager();
        $eventManager = $event->getTarget()->getEventManager();

        $bookingListener = $serviceManager->get(BookingListener::class);
        $bookingListener->attach($eventManager);
    }
}
