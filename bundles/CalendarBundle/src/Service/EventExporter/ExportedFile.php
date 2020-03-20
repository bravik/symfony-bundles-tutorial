<?php
/**
 * @author Roman Naumenko <naumenko_subscr@mail.ru>
 */

declare(strict_types=1);

namespace bravik\CalendarBundle\Service\EventExporter;

/**
 * Abstracts the file, which should be a result of Event export
 */
class ExportedFile
{
    /** @var string */
    private $filename;

    /** @var string */
    private $contentType;

    private $body;

    /**
     * @param string $filename
     * @param string $contentType
     * @param $body
     */
    public function __construct(string $filename, string $contentType, $body)
    {
        $this->filename = $filename;
        $this->contentType = $contentType;
        $this->body = $body;
    }

    /**
     * @return string
     */
    public function getFilename(): string
    {
        return $this->filename;
    }

    /**
     * @return string
     */
    public function getContentType(): string
    {
        return $this->contentType;
    }

    public function getBody()
    {
        return $this->body;
    }
}
