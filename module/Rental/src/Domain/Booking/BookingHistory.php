<?php

namespace Rental\Domain\Booking;

use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="Rental\Infrastructure\Repository\BookingHistoryRepository")
 */
class BookingHistory
{
    /**
     * @ORM\Id
     * @ORM\Column(name="id", type="guid")
     * @ORM\GeneratedValue(strategy="UUID")
     */
    protected string $id;

    /**
     * @ORM\Column(type="string")
     */
    protected string $tenantId;

    /**
     * @ORM\Column(type="string")
     */
    protected string $resourceId;

    /**
     * @ORM\Column(type="string")
     */
    protected string $resourceType;

    /**
     * @ORM\Column(type="string")
     */
    protected string $data;

    public function __construct(string $resourceId, string $resourceType, string $tenantId, string $data)
    {
        $this->resourceId = $resourceId;
        $this->resourceType = $resourceType;
        $this->tenantId = $tenantId;
        $this->data = $data;
    }
}
