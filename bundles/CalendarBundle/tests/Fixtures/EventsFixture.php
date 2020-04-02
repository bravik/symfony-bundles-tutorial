<?php

namespace bravik\CalendarBundle\Tests\Fixtures;

use bravik\CalendarBundle\Entity\Event;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class EventsFixture extends Fixture
{
    /** @var ObjectManager */
    private $manager;

    public function load(ObjectManager $manager)
    {
        $this->manager = $manager;

        $this->createEventFromArray([
            'title' => 'Example event',
            'startsAt' => '2018-01-01 00:00:00',
            'endsAt' => '2018-01-02 00:00:00',
            'description' => 'Description',
            'venueAddress' => 'Venue address',
            'venueName' => 'Venue name',
        ]);

        $manager->flush();
    }

    private function createEventFromArray(array $attributes): void
    {
        $event = new Event();
        $event->setTitle($attributes['title'] ?? null);
        $event->setStartsAt($attributes['startsAt'] ? new \DateTime($attributes['startsAt']) : null);
        $event->setEndsAt($attributes['endsAt'] ? new \DateTime($attributes['endsAt']) : null);
        $event->setDescription($attributes['description'] ?? null);
        $event->setVenueAddress($attributes['venueAddress'] ?? null);
        $event->setVenueName($attributes['venueName'] ?? null);

        $this->manager->persist($event);
    }
}
