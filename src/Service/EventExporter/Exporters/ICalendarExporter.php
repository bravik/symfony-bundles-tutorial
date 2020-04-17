<?php
/**
 * @author Roman Naumenko <naumenko_subscr@mail.ru>
 */

declare(strict_types=1);

namespace App\Service\EventExporter\Exporters;

use App\Entity\Event;
use App\Service\EventExporter\AbstractFileExporter;
use App\Service\EventExporter\ExportedFile;
use App\Service\EventExporter\Helpers\ICSGenerator;


/**
 * Generates a file in format recognizable by iCalendar app
 */
class ICalendarExporter extends AbstractFileExporter
{

    public function getName(): string
    {
        return 'iCalendar';
    }

    public function getType(): string
    {
        return 'icalendar';
    }

    public function export(Event $event): ExportedFile
    {
        // Uses some 3rd party ISC generator class to generate string body for iCalendar file
        $ics = new ICSGenerator([
            'dtstart' => null !== $event->getStartsAt() ? $event->getStartsAt()->format('Y-m-d H:i:s') : '',
            'dtend' => null !== $event->getEndsAt() ? $event->getEndsAt()->format('Y-m-d H:i:s') : '',
            'location' => implode(
                ', ',
                array_filter([
                    $event->getVenueName(),
                    $event->getVenueAddress(),
                ])
            ),
            'summary' => $event->getTitle(),
        ]);

        return new ExportedFile('event.ics', 'text/calendar; charset=utf-8', $ics->to_string());
    }
}