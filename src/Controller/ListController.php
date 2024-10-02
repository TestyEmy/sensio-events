<?php

namespace App\Controller;

use App\Entity\Event;
use App\Entity\Project;
use App\Repository\EventRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ListController extends AbstractController
{
    #[Route('/events', name: 'app_events', methods: ['GET'])]
    public function getEvent(EventRepository $event): Response
    {
        $events = $event->findEventsBetweenDates('2024-01-01','2024-12-31');
        $eventMap = [];
        
        foreach ($events as $event) {
            $eventMap[$event->getId()] = $event->getName();
        }

        return $this->json($eventMap);
    }

    #[Route('/event/{id}', name: 'app_event', requirements: ['id' => '\d+'], methods: ['GET'])]
    public function ListEvents(Event $event): Response
    {
        return $this->json([$event->getId() => $event->getName()]);
    }

    #[Route(
        '/event/{name}/{startDate}/{endDate}',
        name: 'app_event_new_event',
        requirements: [
            'name' => '\w+',
            'startDate' => '\d{4}-\d{2}-\d{2}',
            'endDate' => '\d{4}-\d{2}-\d{2}',
            ]
    )]
    public function newEvent(string $name, string $startDate, string $endDate, EntityManagerInterface $entityManager): Response
    {
        $project = (new Project())
            ->setName($name)
            ->setSummary('')
            ->setCreatedAt(new \DateTimeImmutable($startDate))
        ;
        $entityManager->persist($project);

        $event = (new Event())
            ->setName($name)
            ->setStartAt(new \DateTimeImmutable($startDate))
            ->setEndAt(new \DateTimeImmutable($endDate))
            ->setProject($project)
        ;

        $entityManager->persist($event);
        $entityManager->flush();

        return new Response('OK', Response::HTTP_CREATED);
    }

}
