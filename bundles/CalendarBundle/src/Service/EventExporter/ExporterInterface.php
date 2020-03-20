<?php
/**
 * @author Roman Naumenko <naumenko_subscr@mail.ru>
 */

declare(strict_types=1);

namespace bravik\CalendarBundle\Service\EventExporter;

use bravik\CalendarBundle\Entity\Event;

/**
 * Defines the format to which event could be exported.
 *
 * Inline exporters export to link href, which can be used by GoogleCalendar for example or other app,
 * Non-inline exporters require additional request to exporting controller, which will produce a downloadable file
 */
interface ExporterInterface
{
    public function getName(): string;

    public function getType(): string;

    public function isInline(): bool;

    public function export(Event $event);
}