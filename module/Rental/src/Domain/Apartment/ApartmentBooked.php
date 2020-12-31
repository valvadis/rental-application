<?php

namespace Rental\Domain\Apartment;

use Ramsey\Uuid\Uuid;
use Rental\Domain\Period;

class ApartmentBooked
{
    private string $id;

    private string $tenantId;

    private string $apartmentId;

    private string $ownerId;

    private \DateTime $createdAt;

    private \DateTime $start;

    private \DateTime $end;

    public function __construct(
        string $id,
        string $tenantId,
        string $ownerId,
        string $apartmentId,
        \DateTime $createdAt,
        \DateTime $start,
        \DateTime $end
    ) {
        $this->id = $id;
        $this->tenantId = $tenantId;
        $this->apartmentId = $apartmentId;
        $this->ownerId = $ownerId;
        $this->createdAt = $createdAt;
        $this->start = $start;
        $this->end = $end;
    }

    public static function create(
        string $tenantId,
        string $ownerId,
        string $apartmentId,
        Period $period
    ): ApartmentBooked {
        $eventId = Uuid::uuid4()->toString();
        $createdAt = new \DateTime;

        return new ApartmentBooked(
            $eventId,
            $tenantId,
            $ownerId,
            $apartmentId,
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

    public function getApartmentId(): string
    {
        return $this->apartmentId;
    }

    public function getOwnerId(): string
    {
        return $this->ownerId;
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