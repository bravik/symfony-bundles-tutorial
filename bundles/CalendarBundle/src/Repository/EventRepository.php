<?php

namespace bravik\CalendarBundle\Repository;

use bravik\CalendarBundle\Entity\Event;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Event|null find($id, $lockMode = null, $lockVersion = null)
 * @method Event|null findOneBy(array $criteria, array $orderBy = null)
 * @method Event[]    findAll()
 * @method Event[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EventRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Event::class);
    }

    public function findNotArchived(int $id): ?Event
    {
        return $this->findOneBy([
            'id' => $id,
            'archived' => false
        ]);
    }

    /**
     * @return Event[]
     */
    public function findAllNotArchived(): array
    {
        return $this->findBy([
            'archived' => false,
        ]);
    }
}
