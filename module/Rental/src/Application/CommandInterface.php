<?php

namespace Rental\Application;

interface CommandInterface
{
    public const SUFIX = 'Handler';

    public function getCommandHandlerName(): string;
}
