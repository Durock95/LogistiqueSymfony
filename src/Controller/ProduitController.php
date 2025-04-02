<?php

namespace App\Controller;

use App\Entity\LigneCommande;
use App\Entity\Produit;
use App\Form\LigneCommandeType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class ProduitController extends AbstractController
{
    // Route qui rend inactif un produit
    #[Route('/produit/inactive/{id}', name: 'produit_inactive', methods: ['GET'], requirements: ['id' => '[1-9][0-9]*'])]
    public function inactive(EntityManagerInterface $entityManager, int $id): Response
    {
        $produit = $entityManager->getRepository(Produit::class)->find($id);
        if (!$produit)
            return new Response("<h1>Ce produit n'existe pas</h1>");
        $produit->setEstActif(false);
        $entityManager->persist($produit);
        $entityManager->flush();
        return $this->redirectToRoute('test9');
    }

    // Route qui rend actif un produit
    #[Route('/produit/active/{id}', name: 'produit_active', methods: ['GET'], requirements: ['id' => '[1-9][0-9]*'])]
    public function active(EntityManagerInterface $entityManager, int $id): Response
    {
        $produit = $entityManager->getRepository(Produit::class)->find($id);
        if (!$produit)
            return new Response("<h1>Ce produit n'existe pas</h1>");
        $produit->setEstActif(true);
        $entityManager->persist($produit);
        $entityManager->flush();
        return $this->redirectToRoute('test9');
    }

    // Route qui list l'ensemble des produits et permet d'ajouter les produits
    #[Route('/produits', name: 'produits', methods: ['GET'])]
    public function produits(EntityManagerInterface $entityManager, Request $request, int $id = 0): Response
    { 
        $produits = $entityManager->getRepository(Produit::class)->findBy([], ['nom' => 'ASC']);
        // $lignes = $id ? $entityManager->getRepository(LigneCommande::class)->findBy([], ['quantite' => 'ASC']) : new LigneCommande;
        // if ($lignes->getQuantite() > 1) {
        // $lignes->getQuantite() - 1;
        //     $entityManager->persist($lignes);
        //     $entityManager->flush();
        // } else {
        //     $entityManager->remove($lignes);
        //     $entityManager->flush();
        // };
        // $form = $this->createForm(LigneCommandeType::class, $ligne);
        // $form->handleRequest($request);
        // if ($form->isSubmitted() && $form->isValid()) {
        //     // $ligne->setQuantite();
        //     $entityManager->persist($ligne);
        //     $entityManager->flush();
        //     return $this->redirectToRoute('produits');
        // }
        return $this->render('produit/produits.html.twig', ['produits' => $produits]);
    }
}
