<?php

namespace bravik\CalendarBundle\Controller;

use bravik\CalendarBundle\Entity\Event;
use bravik\CalendarBundle\Service\EventExporter\AbstractFileExporter;
use bravik\CalendarBundle\Service\EventExporter\ExporterManager;
use bravik\CalendarBundle\Repository\EventRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/event", name="event.")
 */
class EventController extends AbstractController
{
    /** @var EventRepository */
    private $eventRepository;

    public function __construct(EventRepository $eventRepository)
    {
        $this->eventRepository = $eventRepository;
    }

    /**
     * @Route("/{id}", name="show", methods={"GET"})
     */
    public function show(int $id, ExporterManager $exporterManager): Response
    {
        $event = $this->getEvent($id);

        return $this->render('@Calendar/show.html.twig', [
            'event' => $event,
            'exporters' => $exporterManager->getAvailableExporters()
        ]);
    }

    /**
     * @Route("/export/{id}/{type}", name="export")
     */
    public function export(int $id, string $type, ExporterManager $exporterManager): Response
    {
        $event = $this->getEvent($id);

        /** @var AbstractFileExporter $exporter */
        if (!$exporter = $exporterManager->findByType($type)) {
            throw new BadRequestHttpException("Export type `$type` doen't exist");
        }

        if ($exporter->isInline()) {
            throw new BadRequestHttpException('Only file exporters accepted by this URL');
        }

        $exportedFile = $exporter->export($event);

        $response = new Response();

        $response->headers->set('Content-Type', $exportedFile->getContentType());
        $response->headers->set('Content-Disposition', "attachment; filename={$exportedFile->getFilename()}");

        $response->setContent($exportedFile->getBody());

        return $response;
    }

    private function getEvent(int $id): Event
    {
        if (!$event = $this->eventRepository->findNotArchived($id)) {
            throw new NotFoundHttpException();
        }

        return $event;
    }
}
