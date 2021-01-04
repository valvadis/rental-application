<?php

namespace Rental\Application;

trait CommandTrait
{
    public function getCommandHandlerName(): string
    {
        return sprintf('%s%s', get_class($this), CommandInterface::SUFIX);
    }
}