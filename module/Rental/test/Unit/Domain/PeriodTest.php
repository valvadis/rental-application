<?php

namespace RentalTest\Unit\Domain;

use DateTime;
use PHPUnit\Framework\TestCase;
use Rental\Domain\Period;

class PeriodTest extends TestCase
{
    public function testPeriodGeneratesDaysCorrectly(): void
    {
        $start = new DateTime('2050-01-21');
        $end = new DateTime('2050-01-30');
        $period = new Period($start, $end);

        $days = $period->asDays();

        $this->assertIsObject($period->getStart());
        $this->assertIsObject($period->getEnd());
        $this->assertEquals($start, $period->getStart());
        $this->assertEquals($end, $period->getEnd());
        $this->assertIsArray($days);
        $this->assertCount(10, $days);
    }
}
