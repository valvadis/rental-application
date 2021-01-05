<?php

namespace Rental\Infrastructure\Repository;

use Doctrine\ORM\EntityRepository;
use Rental\Domain\Apartment\Apartment;
use Rental\Domain\Apartment\ApartmentRepository as ApartmentRepositoryInterface;
use Rental\Domain\Apartment\ApartmentRoom;

class ApartmentRepository extends EntityRepository implements ApartmentRepositoryInterface
{
    public function save(Apartment $apartment): void
    {
        /** @var ApartmentRoom $apartmentRoom */
        foreach ($apartment->getRooms() as $apartmentRoom) {
            $apartmentRoom->setApartment($apartment);
        }

        $this->getEntityManager()->persist($apartment);
        $this->getEntityManager()->flush();
    }

    public function findOneById(string $id): Apartment
    {
        $queryBuilder = $this->createQueryBuilder('a')
            ->where('a.id = :id')
            ->setParameter('id', $id);

        return $queryBuilder->getQuery()->getOneOrNullResult();
    }
}
