<?php

declare(strict_types=1);

namespace Rental\Application;

use Interop\Container\ContainerInterface;

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

        if (!$this->container->has($commandHandlerName)) {
            throw new CommandHandlerNotFoundException(get_class($command));
        }

        $handler = $this->container->get($commandHandlerName);
        $handler->handle($command);
    }
}