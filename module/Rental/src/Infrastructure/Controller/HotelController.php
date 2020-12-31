<?php

namespace Rental\Infrastructure\Controller;

use Laminas\Mvc\Controller\AbstractRestfulController;
use Laminas\View\Model\JsonModel;
use Rental\Application\Service\HotelService;

class HotelController extends AbstractRestfulController
{
    private HotelService $hotelService;

    public function __construct(HotelService $hotelService)
    {
        $this->hotelService = $hotelService;
    }

    public function create($data): JsonModel
    {
        $this->hotelService->add(
            $data['name'],
            $data['street'],
            $data['postalCode'],
            $data['houseNumber'],
            $data['apartmentNumber'],
            $data['city'],
            $data['country']
        );

        return new JsonModel([
            'status' => 'OK'
        ]);
    }
}