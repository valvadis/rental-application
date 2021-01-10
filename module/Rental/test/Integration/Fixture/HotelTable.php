<?php

namespace RentalTest\Integration\Fixture;

use Genesis\DataMods\Traits\SimplifiedDeclarations;
use Genesis\SQLExtensionWrapper\BaseProvider;

class HotelTable extends BaseProvider
{
    use SimplifiedDeclarations;

    private static $baseTable = 'Hotel';

    private static $dataMapping = [
        'id' => 'id',
        'name' => 'name',
        'street' => 'street',
        'postalCode' => 'postalCode',
        'houseNumber' => 'houseNumber',
        'apartmentNumber' => 'apartmentNumber',
        'city' => 'city',
        'country' => 'country',
    ];
}
