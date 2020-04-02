<?php

namespace bravik\CalendarBundle\Controller;

use bravik\CalendarBundle\Tests\Fixtures\EventsFixture;
use Liip\TestFixturesBundle\Test\FixturesTrait;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class EventControllerTest extends WebTestCase
{
    use FixturesTrait;

    protected function setUp()
    {
        $this->loadFixtures([
            EventsFixture::class
        ]);

    }

    public function testShow(): void
    {
        $client = static::createClient();

        $client->request('GET', '/event/1');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
//        self::assertSelectorTextContains('title', 'Example event');
    }

    public function testNotFound(): void
    {
        $client = static::createClient();

        $client->request('GET', '/event/1234');

        $this->assertEquals(404, $client->getResponse()->getStatusCode());
    }
}
