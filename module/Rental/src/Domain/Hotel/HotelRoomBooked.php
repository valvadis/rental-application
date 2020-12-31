<?php

namespace Rental\Domain\Apartment;

use Ramsey\Uuid\Uuid;
use Rental\Domain\Period;

class HotelRoomBooked
{
    private string $id;

    private string $tenantId;

    private string $hotelId;

    private \DateTime $createdAt;

    private \DateTime $start;

    private \DateTime $end;

    public function __construct(
        string $id,
        string $tenantId,
        string $hotelId,
        \DateTime $createdAt,
        \DateTime $start,
        \DateTime $end
    ) {
        $this->id = $id;
        $this->tenantId = $tenantId;
        $this->hotelId = $hotelId;
        $this->createdAt = $createdAt;
        $this->start = $start;
        $this->end = $end;
    }

    public static function create(
        string $tenantId,
        string $hotelId,
        Period $period
    ): HotelRoomBooked {
        $eventId = Uuid::uuid4()->toString();
        $createdAt = new \DateTime;

        return new HotelRoomBooked(
            $eventId,
            $tenantId,
            $hotelId,
            $createdAt,
            $period->getStart(),
            $period->getEnd()
        );
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getTenantId(): string
    {
        return $this->tenantId;
    }

    public function getHotelId(): string
    {
        return $this->hotelId;
    }

    public function getCreatedAt(): \DateTime
    {
        return $this->createdAt;
    }

    public function getStart(): \DateTime
    {
        return $this->start;
    }

    public function getEnd(): \DateTime
    {
        return $this->end;
    }
}