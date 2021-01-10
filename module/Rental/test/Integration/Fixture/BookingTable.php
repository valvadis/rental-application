<?php

namespace RentalTest\Integration\Fixture;

use Genesis\DataMods\Traits\SimplifiedDeclarations;
use Genesis\SQLExtensionWrapper\BaseProvider;

class BookingTable extends BaseProvider
{
    use SimplifiedDeclarations;

    private static $baseTable = 'Booking';

    private static $dataMapping = [
        'id' => 'id',
        'hotelRoomId' => 'hotelRoom_id',
        'apartmentId' => 'apartment_id',
        'rentalType' => 'rentalType',
        'tenantId' => 'tenantId',
        'status' => 'status',
    ];
}