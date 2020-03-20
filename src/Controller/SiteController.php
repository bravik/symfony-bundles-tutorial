<?php

namespace App\Controller;

use bravik\CalendarBundle\Repository\EventRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class SiteController extends AbstractController
{
    public function index(EventRepository $eventRepository)
    {
        $events = $eventRepository->findAllNotArchived();

        return $this->render('site/index.html.twig', [
            'events' => $events,
            'hasMore' => true, // Mock
        ]);
    }
}
