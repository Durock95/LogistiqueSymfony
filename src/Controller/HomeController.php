<?php

namespace App\Controller;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class HomeController extends AbstractController{
    #[Route('/home', name: 'home', methods: ['GET'])]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $roles = $entityManager->getRepository(User::class)->findBy([], ['nom' => 'ASC']);
        return $this->render('home/home.html.twig', ['roles' => $roles]);
    }
}
