<?php

namespace RentalTest\Integration\Fixture;

use Genesis\DataMods\Traits\SimplifiedDeclarations;
use Genesis\SQLExtensionWrapper\BaseProvider;

class HotelRoomTable extends BaseProvider
{
    use SimplifiedDeclarations;

    private static $baseTable = 'HotelRoom';

    private static $dataMapping = [
        'id' => 'id',
        'hotelId' => 'hotel_id',
        'number' => 'number',
        'description' => 'description',
    ];
}