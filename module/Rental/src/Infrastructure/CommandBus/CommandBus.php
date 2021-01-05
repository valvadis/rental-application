<?php

namespace Rental\Infrastructure\CommandBus;

use Interop\Container\ContainerInterface;
use Rental\Application\CommandInterface;

class CommandBus
{
    private ContainerInterface $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function execute(CommandInterface $command): void
    {
        $commandHandlerName = $command->getCommandHandlerName();

        if (! $this->container->has($commandHandlerName)) {
            throw new CommandHandlerNotFoundException(get_class($command));
        }

        $handler = $this->container->get($commandHandlerName);
        $handler->handle($command);
    }
}
