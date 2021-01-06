<?php

namespace Rental\Domain\Hotel;

use DateTime;
use Doctrine\Common\Collections\Collection;

final class HotelRoomBooked
{
    private string $hotelRoomId;

    private string $tenantId;

    private array $days;

    private DateTime $createdAt;

    public function __construct(string $hotelRoomId, string $tenantId, array $days)
    {
        $this->hotelRoomId = $hotelRoomId;
        $this->tenantId = $tenantId;
        $this->days = $days;
        $this->createdAt = new DateTime();
    }

    public function getHotelRoomId(): string
    {
        return $this->hotelRoomId;
    }

    public function getTenantId(): string
    {
        return $this->tenantId;
    }

    public function getDays(): array
    {
        return $this->days;
    }
}
