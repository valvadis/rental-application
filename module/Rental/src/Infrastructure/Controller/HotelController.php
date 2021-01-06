<?php

namespace Rental\Infrastructure\Controller;

use Laminas\Mvc\Controller\AbstractRestfulController;
use Laminas\View\Model\JsonModel;
use Rental\Application\Service\HotelService;
use Rental\Query\Repository\HotelQueryRepository;

class HotelController extends AbstractRestfulController
{
    private HotelService $hotelService;

    private HotelQueryRepository $hotelQueryRepository;

    public function __construct(HotelService $hotelService, HotelQueryRepository $hotelQueryRepository)
    {
        $this->hotelService = $hotelService;
        $this->hotelQueryRepository = $hotelQueryRepository;
    }

    public function getList()
    {
        return new JsonModel([
            'data' => $this->hotelQueryRepository->findAll()
        ]);
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
