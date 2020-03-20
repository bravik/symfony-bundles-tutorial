<?php

namespace bravik\CalendarBundle\Controller;

use bravik\CalendarBundle\Entity\Event;
use bravik\CalendarBundle\Form\EventType;
use bravik\CalendarBundle\Repository\EventRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/editor", name="editor.")
 */
class EditorController extends AbstractController
{
    /** @var EventRepository */
    private $eventRepository;

    private $isSoftDeleteEnabled;

    public function __construct(EventRepository $eventRepository, bool $enableSoftDelete = false)
    {
        $this->eventRepository = $eventRepository;
        $this->isSoftDeleteEnabled = $enableSoftDelete;
    }

    /**
     * @Route("/", name="index", methods={"GET"})
     */
    public function index(): Response
    {
        $events = $this->eventRepository->findAll();

        return $this->render('@Calendar/editor/index.html.twig', [
            'events' => $events,
            'isSoftDeleteEnabled' => $this->isSoftDeleteEnabled,
        ]);
    }

    /**
     * @Route("/new", name="new", methods={"GET","POST"})
     */
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $event = new Event();
        $form = $this->createForm(EventType::class, $event);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($event);
            $entityManager->flush();

            return $this->redirectToRoute('editor.index');
        }

        return $this->render('@Calendar/editor/edit.html.twig', [
            'event' => $event,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}/edit", name="edit", methods={"GET","POST"})
     */
    public function edit(int $id, Request $request, EntityManagerInterface $entityManager): Response
    {
        $event = $this->getEvent($id);

        $form = $this->createForm(EventType::class, $event);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('editor.index');
        }

        return $this->render('@Calendar/editor/edit.html.twig', [
            'event' => $event,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}/delete", name="delete")
     */
    public function delete(int $id, EntityManagerInterface $entityManager): Response
    {
        $event = $this->getEvent($id);

        if ($this->isSoftDeleteEnabled) {
            $event->setArchived(true);
        } else {
            $entityManager->remove($event);
        }

        $entityManager->flush();

        return $this->redirectToRoute('editor.index');
    }

    private function getEvent(int $id): Event
    {
        if (!$event = $this->eventRepository->findNotArchived($id)) {
            throw new NotFoundHttpException();
        }

        return $event;
    }
}
