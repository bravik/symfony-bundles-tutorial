<?php
/**
 * @author Roman Naumenko <naumenko_subscr@mail.ru>
 */

declare(strict_types=1);

namespace App\Service\EventExporter;

use bravik\CalendarBundle\Entity\Event;
use bravik\CalendarBundle\Service\EventExporter\AbstractFileExporter;
use bravik\CalendarBundle\Service\EventExporter\ExportedFile;

/**
 * Generates a JSON file
 */
class JsonExporter extends AbstractFileExporter
{
    private const DATE_FORMAT = 'Y-m-d H:i:s';

    public function getName(): string
    {
        return 'Файл JSON';
    }

    public function getType(): string
    {
        return 'json-file';
    }

    public function export(Event $event): ExportedFile
    {
        $data = [
            'id'            => $event->getId(),
            'title'         => $event->getTitle(),
            'description'   => $event->getDescription(),
            'venueName'     => $event->getVenueName(),
            'venueAddress'  => $event->getVenueAddress(),
            'startsAt'      => $event->getStartsAt()->format(self::DATE_FORMAT),
            'endsAt'        => $event->getEndsAt() ? $event->getEndsAt()->format(self::DATE_FORMAT) : null,
        ];
        return new ExportedFile('event.json', 'application/json', json_encode($data));
    }
}