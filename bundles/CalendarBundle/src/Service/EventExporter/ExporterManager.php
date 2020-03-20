<?php
/**
 * @author Roman Naumenko <naumenko_subscr@mail.ru>
 */

declare(strict_types=1);

namespace bravik\CalendarBundle\Service\EventExporter;

class ExporterManager
{
    /** @var ExporterInterface[] */
    private $exporters;

    /**
     * @param ExporterInterface[] $exporters
     */
    public function __construct(iterable $exporters = [])
    {
        $this->exporters = [];
        foreach ($exporters as $exporter) {
            $this->registerExporter($exporter);
        }
    }

    public function registerExporter(ExporterInterface $exporter): void
    {
        $this->exporters[$exporter->getType()] = $exporter;
    }

    public function findByType(string $type): ?ExporterInterface
    {
        return $this->exporters[$type] ?? null;
    }

    /**
     * @return ExporterInterface[]
     */
    public function getAvailableExporters(): array
    {
        return $this->exporters;
    }
}
