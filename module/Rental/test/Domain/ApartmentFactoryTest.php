<?php

namespace RentalTest\Domain;

use Doctrine\Common\Collections\ArrayCollection;
use PHPUnit\Framework\TestCase;
use Rental\Domain\Apartment\Apartment;
use Rental\Domain\Apartment\ApartmentFactory;

class ApartmentFactoryTest extends TestCase
{
    public function testApartmentFactoryCreatesObjectCorrectly(): void
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

        $this->assertIsObject($apartment);
        $this->assertEquals(Apartment::class, get_class($apartment));
        $this->assertEquals(ArrayCollection::class, get_class($apartment->getRooms()));
        $this->assertCount(2, $apartment->getRooms());
    }
}