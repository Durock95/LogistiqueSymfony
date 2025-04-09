<?php

namespace App\Controller;

use CalendarBundle\Controller;
use App\Entity\Booking;
use App\Form\BookingType;
use App\Repository\BookingRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/booking')]
final class BookingController extends AbstractController{
    #[Route('/calendar', name: 'app_booking_calendar', methods: ['GET'])]
    public function calendar(EntityManagerInterface $entityManager, BookingRepository $booking): Response
    {
        $events = $booking->findAll();
        // dd($events);
        $rdvs = [];

        foreach($events as $event) {
            $rdvs[] = [
                'id' => $event->getId(),
                'start' => $event->getStart()->format('Y-m-d H:i:s'),
                'end' => $event->getEnd()->format('Y-m-d H:i:s'),
                'title' => $event->getTitle(),
                // 'backgroundColor' => $event->getBackgroundColor(),
                // 'borderColor' => $event->getBorderColor(),
                // 'textColor' => $event->getTextColor(),
                // 'allDay' => $event->getAllDay(),

            ];
        }
        $data = json_encode(($rdvs));

        return $this->render('booking/calendar.html.twig', ['data' => $data]);
    }

    #[Route('/index', name: 'app_booking_index', methods: ['GET'])]
    public function index(EntityManagerInterface $entityManager, BookingRepository $bookingRepository): Response
    {
        // $bookings = $entityManager->getRepository(Booking::class)->findBy([], ['title' => 'ASC'])
        return $this->render('booking/index.html.twig', [
            'bookings' => $bookingRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_booking_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $booking = new Booking();
        $form = $this->createForm(BookingType::class, $booking);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($booking);
            $entityManager->flush();

            return $this->redirectToRoute('app_booking_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('booking/new.html.twig', [
            'booking' => $booking,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_booking_show', methods: ['GET'])]
    public function show(Booking $booking): Response
    {
        return $this->render('booking/show.html.twig', [
            'booking' => $booking,
        ]);
    }

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

    #[Route('/event/edit/{id}', name: 'event_booking_edit', methods: ['GET'], requirements: ['id' => '[1-9][0-9]*'])]
    public function eventEdit(Booking $booking, EntityManagerInterface $entityManager, $id): Response
    {
        $donnees = $entityManager->getRepository(Booking::class)->find($id);
        if (!$donnees || $donnees->getTitle() !== '') {
            $booking = new Booking();
            $booking->getId();
            $booking->setTitle($donnees->title);
            $booking->setStart($donnees->start);
            $booking->setEnd($donnees->end);
            $entityManager->persist($booking);
            $entityManager->flush();
        }

        return $this->render('booking/calendar.html.twig', [
            'booking' => $booking,
        ]);
    }

    #[Route('/{id}', name: 'app_booking_delete', methods: ['POST'])]
    public function delete(Request $request, Booking $booking, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$booking->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($booking);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_booking_index', [], Response::HTTP_SEE_OTHER);
    }

}
