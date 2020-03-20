<?php
/**
 * @author Roman Naumenko <naumenko_subscr@mail.ru>
 */

declare(strict_types=1);

namespace bravik\CalendarBundle\Service\EventExporter\Exporters;

use bravik\CalendarBundle\Entity\Event;
use bravik\CalendarBundle\Service\EventExporter\AbstractInlineExporter;

/**
 * Generates a special link which GoogleCalendar app will recognize
 */
class GoogleCalendarExporter extends AbstractInlineExporter
{
    private const DATE_FORMAT = 'Ymd\THis';

    public function getName(): string
    {
        return 'Google Calendar';
    }

    public function getType(): string
    {
        return 'google-calendar';
    }

    public function export(Event $event): string
    {
        $href = "http://www.google.com/calendar/event?action=TEMPLATE&text={$event->getTitle()}&dates="
            . $event->getStartsAt()->format(self::DATE_FORMAT);

        $href .= $event->getEndsAt()
                ? '/' . $event->getEndsAt()->format(self::DATE_FORMAT)
                : '/' . $event->getStartsAt()->format(self::DATE_FORMAT)
        ;

        $location = implode(
            ', ',
            array_filter([
                $event->getVenueName(),
                $event->getVenueAddress(),
            ])
        );

        $href .= "&details=&location=$location";

        return $href;
    }
}