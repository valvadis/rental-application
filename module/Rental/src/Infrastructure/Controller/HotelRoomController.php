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
        $content = $this->getRequest()->getContent();
        $data = Json::decode($content, Json::TYPE_OBJECT);

        $this->hotelRoomService->add(
            $data->hotelId,
            $data->number,
            $data->description,
            $data->spaces
        );

        return new JsonModel([
            'status' => 'OK'
        ]);
    }
}