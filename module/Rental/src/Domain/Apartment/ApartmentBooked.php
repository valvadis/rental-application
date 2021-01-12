<?php

namespace Rental\Domain\Apartment;

use DateTime;
use Rental\Domain\Period;

final class ApartmentBooked
{
    private string $apartmentId;

    private string $tenantId;

    private Period $period;

    private DateTime $createdAt;

    public function __construct(string $apartmentId, string $tenantId, Period $period)
    {
        $this->apartmentId = $apartmentId;
        $this->tenantId = $tenantId;
        $this->period = $period;
        $this->createdAt = new DateTime();
    }

    public function getApartmentId(): string
    {
        return $this->apartmentId;
    }

    public function getTenantId(): string
    {
        return $this->tenantId;
    }

    public function getPeriod(): Period
    {
        return $this->period;
    }
}
