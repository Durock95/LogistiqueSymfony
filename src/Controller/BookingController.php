<?php

namespace App\Controller;

use App\Entity\User;
use CalendarBundle\Controller;
use App\Entity\Booking;
use App\Form\BookingType;
use App\Repository\BookingRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;


#[Route('/booking')]
final class BookingController extends AbstractController
{
    // Route qui affiche le calendrier
    #[Route('/calendar', name: 'app_booking_calendar', methods: ['GET', 'POST'])]
    public function calendar(EntityManagerInterface $entityManager, BookingRepository $bookingRepository): Response
    {
        $bookings = $bookingRepository->findAll();
        // dd($events);
        $events = [];

        foreach ($bookings as $booking) {
            $events[] = [
                'id' => (string)$booking->getId(),
                'start' => $booking->getStart()->format('Y-m-d H:i:s'),
                'end' => $booking->getEnd()->format('Y-m-d H:i:s'),
                'title' => $booking->getTitle(),
                // 'backgroundColor' => $event->getBackgroundColor(),
                // 'borderColor' => $event->getBorderColor(),
                // 'textColor' => $event->getTextColor(),
                // 'allDay' => $event->getAllDay(),
                'url' => '/booking/' . $booking->getId(),
            ];
        }
//        dd($events);
//        return new JsonResponse($events);
//            ['id' => '1', 'title' => 'Test Event', 'start' => '2025-04-10T10:00:00', 'end' => '2025-04-10T12:00:00']]);
//        $data = json_encode($events);
//, ['data' => $data]
        return $this->render('booking/calendar.html.twig', ['events' => $events]);
    }

    // Route qui affiche la liste des évènements
    #[Route('/index', name: 'booking_index', methods: ['GET'])]
    public function index(EntityManagerInterface $entityManager, BookingRepository $bookingRepository): Response
    {
        // $bookings = $entityManager->getRepository(Booking::class)->findBy([], ['title' => 'ASC'])
        $eventCat = $entityManager->getRepository(Booking::class)->findBy([], ['title' => 'ASC']);
        return $this->render('booking/index.html.twig', [
            'bookings' => $bookingRepository->findAll(),
            'eventCat' => $eventCat
        ]);
    }

    // Route affichant le formulaire de création d'un évènement
    #[Route('/new', name: 'app_booking_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager, int $id = 0): Response
    {
        $booking = new Booking();
        $eventCat = $entityManager->getRepository(Booking::class)->findBy(['id' => $id, 'title' => 'ASC']);
        $users = $entityManager->getRepository(User::class)->findBy(['id' => $id, 'nom' => 'ASC']);
        $form = $this->createForm(BookingType::class, $booking, ['eventCat' => $eventCat, 'users' => $users]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $booking->setTitle($form->get('title')->getData());
            $booking->setStart(new \DateTime());
            $booking->setEnd(new \DateTime());
            $entityManager->persist($booking);
            $entityManager->flush();

            return $this->redirectToRoute('booking_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('booking/new.html.twig', [
//            'booking' => $booking,
//            'eventCat' => $eventCat,
            'form' => $form,
        ]);
    }

    // Route qui affiche les détails d'un évènement
    #[Route('/{id}', name: 'app_booking_show', methods: ['GET'])]
    public function show(Booking $booking): Response
    {
        return $this->render('booking/show.html.twig', [
            'booking' => $booking,
        ]);
    }

    // Route qui affiche le formulaire de modification d'un évènement
    #[Route('/{id}/edit', name: 'app_booking_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Booking $booking, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(BookingType::class, $booking);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_booking_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('booking/edit.html.twig', [
            'booking' => $booking,
            'form' => $form,
        ]);
    }

//    #[Route('/event/edit/{id}', name: 'event_booking_edit', methods: ['GET'], requirements: ['id' => '[1-9][0-9]*'])]
//    public function eventEdit(Booking $booking, EntityManagerInterface $entityManager, $id): Response
//    {
//        $donnees = $entityManager->getRepository(Booking::class)->find($id);
//        if (!$donnees || $donnees->getTitle() !== '') {
//            $booking = new Booking();
//            $booking->getId();
//            $booking->setTitle($donnees->title);
//            $booking->setStart($donnees->start);
//            $booking->setEnd($donnees->end);
//            $entityManager->persist($booking);
//            $entityManager->flush();
//        }
//
//        return $this->render('booking/calendar.html.twig', [
//            'booking' => $booking,
//        ]);

//    }

    // Route pour supprimer un évènement
    #[Route('/{id}', name: 'app_booking_delete', methods: ['POST'])]
    public function delete(Request $request, Booking $booking, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete' . $booking->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($booking);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_booking_index', [], Response::HTTP_SEE_OTHER);
    }

}
