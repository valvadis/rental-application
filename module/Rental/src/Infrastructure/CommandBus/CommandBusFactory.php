<?php

namespace Rental\Infrastructure\CommandBus;

use Interop\Container\ContainerInterface;

class CommandBusFactory
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null): CommandBus
    {
        return new CommandBus($container);
    }
}
