<?php
/**
 * @author Roman Naumenko <naumenko_subscr@mail.ru>
 */

declare(strict_types=1);

namespace App\Service\EventExporter;

use App\Entity\Event;

/**
 * Base class for all file exporters
 */
abstract class AbstractFileExporter implements ExporterInterface
{

    final public function isInline(): bool
    {
        return false;
    }

    abstract public function export(Event $event): ExportedFile;
}
