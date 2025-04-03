<?php

namespace App\Controller;

use App\Entity\PointDeVente;
use App\Form\PointDeVenteType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class PointDeVenteController extends AbstractController
{
    #[Route('/pointsdevente', name: 'pointsdevente', methods: ['GET'])]
    public function points(EntityManagerInterface $entityManager): Response
    {
        $pointsDeVente = $entityManager->getRepository(PointDeVente::class)->findBy([], ['nom' => 'ASC']);
        return $this->render('point_de_vente/pointsdevente.html.twig', ['pointsDeVente' => $pointsDeVente]);
    }

    #[Route('/managepdv/{id}', name: 'managepdv', methods: ['GET', 'POST'], requirements: ['id' => '[1-9][0-9]*'])]
    public function managePdv(Request $request, EntityManagerInterface $entityManager, int $id = 0): Response
    {
        $pointDeVente = $id ? $entityManager->getRepository(PointDeVente::class)->find($id) : new PointDeVente();
        $form = $this->createForm(PointDeVenteType::class, $pointDeVente); 
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($pointDeVente);
            $entityManager->flush();
            return $this->redirectToRoute('pointsdevente');
        }
        return $this->render('point_de_vente/managepdv.html.twig', ['form' => $form]);
    }
}
