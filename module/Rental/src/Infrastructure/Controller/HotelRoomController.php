<?php

namespace Rental\Infrastructure\Controller;

use DateTime;
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
        $hotelRoomId = $this->params()->fromRoute('id');
        $content = $this->getRequest()->getContent();
        $data = Json::decode($content, Json::TYPE_ARRAY);

        $hotelRoomBooked = $this->hotelRoomService->book(
            $hotelRoomId,
            $data['tenantId'],
            $data['days']
        );

        $this->getEventManager()->trigger(get_class($hotelRoomBooked), $this, $hotelRoomBooked);

        return new JsonModel([
            'status' => 'OK'
        ]);
    }
}
