<?php

namespace App\Controller;

use App\Entity\Booking;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class ApiController extends AbstractController{
    #[Route('/api', name: 'app_api')]
    public function index(): Response
    {
        return $this->render('api/index.html.twig', [
            'controller_name' => 'ApiController',
        ]);
    }

    #[Route('/api/{id}/edit', name: 'api_event_edit', methods: ['PUT'])]
    public function majEvent(?Booking $booking, Request $request, EntityManagerInterface $entityManager, int $id)
    {
        // On récupère les données
        $donnees = $entityManager->getRepository(Booking::class)->find($id);
        $id = $request->query->get('id', $id = null);
        // $donnees = $request->query->get();
        // $donnees = json_encode(($request->getContent()));

        if (
            // !$donnees->title && !$donnees->start && !$donnees->end)
            isset($id) && !empty($id) &&
            isset($donnees->title) && !empty($donnees->title) &&
            isset($donnees->start) && !empty($donnees->start) &&
            isset($donnees->end) && !empty($donnees->end)
            ) 
            // isset($donnees->description) && !empty($donnees->description) &&
            // isset($donnees->backgroundColor) && !empty($donnees->backgroundColor) &&
            // isset($donnees->borderColor) && !empty($donnees->borderColor) &&
            // isset($donnees->textColor) && !empty($donnees->textColor) &&
        {
            // Les données sont complètes
            // On initialise un code
            $code = 200;
            // On vérifié si l'id existe
            // $booking = $id ? $entityManager->getRepository(Booking::class)->find($id) : new Booking;
            if (!$booking){
                // On instancie un rdv
                $booking = new Booking;
                // On change le code
                $code = 201;
            
                // On hydrate l'objet avec les données
                $booking->getId($id);
                $booking->setTitle($donnees->title);
                $booking->setStart(new DateTime($donnees->start));
                $booking->setEnd(new DateTime($donnees->end));
                // if ($donnees->allDay){
                //     $booking->setEnd(new DateTime($donnees->start));
                // } else {
                //     $booking->setEnd(new DateTime($donnees->end));
                // }
                // $booking->setAllDay($donnees->allDay);
                // $booking->setDescription($donnees->description);
                // $booking->setBackgroundColor($donnees->backgroundColor);
                // $booking->setTextColor($donnees->textColor);
                // $booking->setBorderColor($donnees->borderColor); 
                // $em = $this->getDoctrine()->getManager();
                $entityManager->persist($booking);
                $entityManager->flush();
                // On retourne le code 
                return new Response('Ok', $code);
            }
        }  else {
            return new Response('Données incomplètes', 404);
            }
            return $this->render('calendar/calendar.html.twig', [
                'controller_name' => 'ApiController'
            ]);
    }
}



