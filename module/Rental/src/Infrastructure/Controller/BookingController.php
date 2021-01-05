<?php

namespace Rental\Infrastructure\Controller;

use Laminas\Mvc\Controller\AbstractRestfulController;
use Laminas\View\Model\JsonModel;
use Rental\Application\Handler\BookingAccept;
use Rental\Application\Handler\BookingReject;
use Rental\Infrastructure\CommandBus\CommandBus;

class BookingController extends AbstractRestfulController
{
    private CommandBus $commandBus;

    public function __construct(CommandBus $commandBus)
    {
        $this->commandBus = $commandBus;
    }

    public function acceptAction(): JsonModel
    {
        $id = $this->params()->fromRoute('id');
        $command = new BookingAccept($id);

        $this->commandBus->execute($command);

        return new JsonModel([
            'status' => 'OK'
        ]);
    }

    public function rejectAction(): JsonModel
    {
        $id = $this->params()->fromRoute('id');
        $command = new BookingReject($id);

        $this->commandBus->execute($command);

        return new JsonModel([
            'status' => 'OK'
        ]);
    }
}
