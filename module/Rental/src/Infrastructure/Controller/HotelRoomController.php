<?php

namespace Rental\Infrastructure\Controller;

use Laminas\Json\Json;
use Laminas\Mvc\Controller\AbstractRestfulController;
use Laminas\View\Model\JsonModel;
use Rental\Application\Service\HotelRoomService;

class HotelRoomController extends AbstractRestfulController
{
    private HotelRoomService $hotelRoomService;

    public function __construct(HotelRoomService $hotelRoomService)
    {
        $this->hotelRoomService = $hotelRoomService;
    }

    public function create($data): JsonModel
    {
        $this->hotelRoomService->add(
            $data['hotelId'],
            $data['number'],
            $data['description'],
            $data['spaces']
        );

        return new JsonModel([
            'status' => 'OK'
        ]);
    }

    public function bookAction(): JsonModel
    {
        $id = $this->params()->fromRoute('id');
        $data = Json::decode($this->getRequest()->getContent(), Json::TYPE_ARRAY);

        $apartmentBooked = $this->hotelRoomService->book($id, $data['tenantId'], $data['start'], $data['end']);
        $this->getEventManager()->trigger('apartmentBooked', $this, $apartmentBooked);

        return new JsonModel([
            'status' => 'OK'
        ]);
    }
}