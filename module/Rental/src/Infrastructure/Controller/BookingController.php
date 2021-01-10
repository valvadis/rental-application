<?php

namespace Rental\Infrastructure\Controller;

use Laminas\Mvc\Controller\AbstractRestfulController;
use Laminas\View\Model\JsonModel;
use Rental\Application\Handler\BookingAccept;
use Rental\Application\Handler\BookingReject;
use Rental\Infrastructure\CommandBus\CommandBus;
use Rental\Query\Repository\BookingQueryRepository;

class BookingController extends AbstractRestfulController
{
    private CommandBus $commandBus;

    private BookingQueryRepository $bookingQueryRepository;

    public function __construct(CommandBus $commandBus, BookingQueryRepository $bookingQueryRepository)
    {
        $this->bookingQueryRepository = $bookingQueryRepository;
        $this->commandBus = $commandBus;
    }

    public function getList()
    {
        return new JsonModel([
            'data' => $this->bookingQueryRepository->findAll()
        ]);
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
