<?php

namespace Rental\Application\Handler;

use Rental\Application\CommandInterface;

trait CommandTrait
{
    public function getCommandHandlerName(): string
    {
        return sprintf('%s%s', get_class($this), CommandInterface::SUFIX);
    }
}