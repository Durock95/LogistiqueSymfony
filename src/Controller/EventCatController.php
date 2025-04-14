<?php

namespace App\Controller;

use App\Entity\Booking;
use App\Entity\EventCat;
use App\Entity\User;
use App\Form\EventCatFormType;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class EventCatController extends AbstractController{

    #[Route('/eventcats', name: 'eventcats', methods: ['GET'])]
    public function eventCats(EntityManagerInterface $entityManager): Response
    {
        $eventCats = $entityManager->getRepository(EventCat::class)->findBy([], ['name' => 'ASC']);
        return $this->render('event_cat/eventcats.html.twig', ['eventCats' => $eventCats]);
    }

    // Route affichant un formulaire de création ou modification d'une catégorie d'évènement
    #[Route('/eventcat/{id}', name: 'eventcat', methods: ['GET', 'POST'], requirements: ['id' => '[1-9][0-9]*'])]
    public function eventCat(EntityManagerInterface $entityManager, Request $request, int $id = 0): Response
    {
        $eventCat = $id ? $entityManager->getRepository(EventCat::class)->find($id) : new EventCat();
//        $bookings = $entityManager->getRepository(Booking::class)->findBy([], ['title' => 'ASC']);
//        $users = $entityManager->getRepository(User::class)->findBy([], ['nom' => 'ASC']);
        $form = $this->createForm(EventCatFormType::class, $eventCat);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
                 $entityManager->persist($eventCat);
                 $entityManager->flush();
                 return $this->redirectToRoute('eventcats');
             }
        return $this->render('event_cat/eventcat.html.twig', ['form' => $form]);
    }
}
