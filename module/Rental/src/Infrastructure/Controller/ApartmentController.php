<?php

namespace Rental\Infrastructure\Controller;

use Laminas\Json\Json;
use Laminas\Mvc\Controller\AbstractRestfulController;
use Laminas\View\Model\JsonModel;
use Rental\Application\Service\ApartmentService;

class ApartmentController extends AbstractRestfulController
{
    private ApartmentService $apartmentService;

    public function __construct(ApartmentService $apartmentService)
    {
        $this->apartmentService = $apartmentService;
    }

    public function create($data): JsonModel
    {
        $this->apartmentService->add(
            $data['ownerId'],
            $data['street'],
            $data['postalCode'],
            $data['houseNumber'],
            $data['apartmentNumber'],
            $data['city'],
            $data['country'],
            $data['description'],
            $data['rooms']
        );

        return new JsonModel([
            'status' => 'OK'
        ]);
    }

    public function bookAction(): JsonModel
    {
        $id = $this->params()->fromRoute('id');
        $data = Json::decode($this->getRequest()->getContent(), Json::TYPE_ARRAY);

        $apartmentBooked = $this->apartmentService->book($id, $data['tenantId'], $data['start'], $data['end']);
        $this->getEventManager()->trigger('apartmentBooked', $this, $apartmentBooked);

        return new JsonModel([
            'status' => 'OK'
        ]);
    }
}