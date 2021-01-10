<?php

namespace RentalTest\Integration\Fixture;

use Genesis\DataMods\Traits\SimplifiedDeclarations;
use Genesis\SQLExtensionWrapper\BaseProvider;

class ApartmentTable extends BaseProvider
{
    use SimplifiedDeclarations;

    private static $baseTable = 'Apartment';

    private static $dataMapping = [
        'id' => 'id',
        'ownerId' => 'ownerId',
        'street' => 'street',
        'postalCode' => 'postalCode',
        'houseNumber' => 'houseNumber',
        'apartmentNumber' => 'apartmentNumber',
        'city' => 'city',
        'country' => 'country',
    ];
}
