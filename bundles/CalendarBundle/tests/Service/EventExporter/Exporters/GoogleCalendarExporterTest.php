<?php
/**
 * @author Roman Naumenko <naumenko_subscr@mail.ru>
 */

declare(strict_types=1);

namespace bravik\CalendarBundle\Tests\Service\EventExporter\Exporters;

use bravik\CalendarBundle\Entity\Event;
use bravik\CalendarBundle\Service\EventExporter\Exporters\GoogleCalendarExporter;
use DateTime;
use PHPUnit\Framework\TestCase;

class GoogleCalendarExporterTest extends TestCase
{
    /** @var GoogleCalendarExporter  */
    private $exporterInstance;

    /** @var Event */
    private $sampleEvent;

    protected function setUp()
    {
        $this->exporterInstance = new GoogleCalendarExporter();
        $this->sampleEvent  = (new Event())
            ->setTitle('Example event')
            ->setStartsAt(new DateTime('2019-01-01 00:00:00'))
            ->setEndsAt(new DateTime('2019-01-02 00:00:00'))
            ->setVenueName('Example venue')
            ->setVenueAddress('Example str, 12')
        ;
    }


    public function testExport(): void
    {
        $expectedString = 'http://www.google.com/calendar/event?action=TEMPLATE&text=Example event&dates='
            . '20190101T000000/20190102T000000&details=&location=Example venue, Example str, 12';

        $result = $this->exporterInstance->export($this->sampleEvent);
        $this->assertIsString($result, 'Result should be a valid string');
        $this->assertEquals($expectedString, $result, 'Generated string has incorrect data');
    }
}