<?php

namespace RentalTest\Unit\Infrastructure;

use Rental\Application\CommandInterface;

class NonExistedCommand implements CommandInterface
{
    public function getCommandHandlerName(): string
    {
        return 'NonExistedCommand';
    }
}