<?php

namespace App\Controller;

use App\Entity\Booking;
use App\Repository\BookingRepository;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class ApiController extends AbstractController
{
    #[Route('/api', name: 'app_api')]
    public function index(): Response
    {
        return $this->render('api/index.html.twig', [
            'controller_name' => 'ApiController',
        ]);
    }

    #[Route('/api/{id}/edit', name: 'api_event_edit', methods: ['GET'])]
    public function majEvent(?Booking $booking, BookingRepository $bookingRepository, Request $request, EntityManagerInterface $entityManager, int $id): Response
    {
        // On récupère les données
        $booking = $bookingRepository->find($id);
        if (!$booking) {
            return new JsonResponse(['error' => 'Évènement non trouvé'], 404);
        }

        $data = json_decode($request->getContent(), true);

        try {
            $start = new \DateTime($data['start']);
            $end = new \DateTime($data['end']);

            return new JsonResponse(['message' => 'Évènement mis à jour'], 200);
        } catch (\Exception $e) {
            return new JsonResponse(['error' => 'Erreur lors de la mise à jour'], 500);
        }
        $booking->getTitle($data['title']);
        $booking->setStart($start);
        $booking->setEnd($end);
        $entityManager->flush();

//        return new JsonResponse(['message' => 'Event successfully updated!'], 200);
        return $this->render('calendar/calendar.html.twig', [
//          'controller_name' => 'ApiController'
            'data' => $data,
        ]);
    }
}



