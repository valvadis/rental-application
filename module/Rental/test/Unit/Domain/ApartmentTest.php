<?php

namespace RentalTest\Unit\Domain;

use Doctrine\Common\Collections\ArrayCollection;
use PHPUnit\Framework\TestCase;
use Rental\Domain\Apartment\ApartmentFactory;
use Rental\Domain\Booking\ApartmentBooking;

class ApartmentTest extends TestCase
{
    public function testApartmentCanBeBookCorrectly(): void
    {
        $apartment = (new ApartmentFactory())->create(
            'OWNER-ID',
            'Example street',
            '12-345',
            '12',
            '21',
            'City',
            'Country',
            'Some description',
            [
                ['name' => 'Room 1', 'size' => 28],
                ['name' => 'Room 2', 'size' => 32],
            ]
        );

        $apartmentBooking = $apartment->book('TENANT-ID', new ArrayCollection([]));

        $this->assertIsObject($apartmentBooking);
        $this->assertEquals(ApartmentBooking::class, get_class($apartmentBooking));
        $this->assertEquals(ArrayCollection::class, get_class($apartmentBooking->getDays()));
        $this->assertCount(0, $apartmentBooking->getDays());
    }
}
