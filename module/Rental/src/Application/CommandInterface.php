<?php

namespace Rental\Application;

interface CommandInterface
{
    const SUFIX = 'Handler';

    public function getCommandHandlerName(): string;
}