<?php

namespace Rental\Domain;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Embeddable
 */
class Period
{
    /**
     * @ORM\Column(type="date")
     */
    private \DateTime $start;

    /**
     * @ORM\Column(type="date")
     */
    private \DateTime $end;

    public function __construct(\DateTime $start, \DateTime $end)
    {
        if ($start > $end) {
            throw new \DomainException('Start date cannot be older than end date.');
        }

        $this->start = $start;
        $this->end = $end;
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