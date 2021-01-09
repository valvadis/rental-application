<?php

namespace RentalTest\Unit\Infrastructure;

use Laminas\Stdlib\ArrayUtils;
use Laminas\Test\PHPUnit\Controller\AbstractHttpControllerTestCase;
use Rental\Application\CommandInterface;
use Rental\Infrastructure\CommandBus\CommandBus;
use Rental\Infrastructure\CommandBus\CommandHandlerNotFoundException;

class CommandBusTest extends AbstractHttpControllerTestCase
{
    /** CommandBus $commandBus */
    private $commandBus;

    protected function setUp(): void
    {
        $configOverrides = [];

        $this->setApplicationConfig(ArrayUtils::merge(
            include __DIR__ . '/../../../../../config/application.config.php',
            $configOverrides
        ));

        parent::setUp();

        $this->commandBus = $this->getApplicationServiceLocator()->get(CommandBus::class);
    }

    public function testExceptionIsThrownWhenExecuteNonExistedCommand()
    {
        $nonExistedCommand = new NonExistedCommand();

        $this->expectException(CommandHandlerNotFoundException::class);
        $this->expectExceptionMessage(get_class($nonExistedCommand));

        $this->commandBus->execute($nonExistedCommand);
    }
}