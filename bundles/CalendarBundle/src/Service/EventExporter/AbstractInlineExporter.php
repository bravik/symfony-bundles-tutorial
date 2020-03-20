<?php
/**
 * @author Roman Naumenko <naumenko_subscr@mail.ru>
 */

declare(strict_types=1);

namespace bravik\CalendarBundle\Service\EventExporter;

use bravik\CalendarBundle\Entity\Event;

/**
 * Base class for all inline exporters
 */
abstract class AbstractInlineExporter implements ExporterInterface
{

    final public function isInline(): bool
    {
        return true;
    }

    abstract public function export(Event $event): string;
}
