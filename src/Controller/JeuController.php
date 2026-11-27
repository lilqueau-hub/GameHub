<?php

namespace App\Controller;

use App\Entity\Categorie;
use App\Entity\Jeu;
use App\Repository\JeuRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class JeuController extends AbstractController
{
    #[Route('/jeu', name: 'app_jeu')]
    public function index(JeuRepository $jeuRepository): Response
    {
        // Récupérer tous les jeux de la bdd
        $jeux = $jeuRepository->findAll();

        return $this->render('jeu/index.html.twig', [
            'jeux' => $jeux,
        ]);
    }

    #[Route('/jeu/recherche', name: 'jeu_recherche')]
    public function recherche(JeuRepository $jeuRepository, Request $request): Response
    {
        $titre = $request->query->get('titre');

        $jeuxTrouve = [];

        if ($titre) {
            $jeuxTrouve = $jeuRepository->rechercheParTitre($titre);
        }

        return $this->render('jeu/recherche.html.twig', [
            'jeux' => $jeuxTrouve,
            'titre' => $titre
        ]);
    }

    #[Route('/jeu/{id}', name: 'jeu_detail', requirements: ['id' => '\d+'])]
    public function afficherDetails(int $id, JeuRepository $jeuRepository): Response
    {
        $jeu = $jeuRepository->find($id);

        if(!$jeu) {
            throw $this->createNotFoundException('jeu introuvable');
        }

        return $this->render('jeu/jeuDetails.html.twig', [
            'jeu' =>$jeu
        ]);
    }

    #[Route('/jeu/ajouter', name: 'jeu_ajout')]
    public function ajouterJeu(Request $request, EntityManagerInterface $em): Response
    {
        $jeu = new Jeu();

        $form= $this->createForm(Categorie::class, $jeu);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($jeu);
            $em->flush();

            return $this->redirectToRoute('app_jeu');
        }
        return $this->render('jeu/ajouterJeu.html.twig', [
            'form' => $form->createView()
        ]);
    }

    #[Route('/jeu/{id}/modifier', name: 'jeu_modification', requirements: ['id' => '\d+'], methods: ['GET', 'POST'])]
    public function modifierJeu(int $id, Request $request, EntityManagerInterface $em, JeuRepository $jeuRepository): Response
    {
        $jeu = $jeuRepository->find($id);
        if (!$jeu) {
            throw $this->createNotFoundException('Jeu introuvable');
        }

        $form = $this->createForm(Categorie::class, $jeu);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->flush();
            return $this->redirectToRoute('app_jeu');
        }
        return $this->render('jeu/modifierJeu.html.twig', [
            'form' => $form->createView(),
            'jeu' => $jeu
        ]);
    }

    #[Route('jeu/{id}/supprimer', name: 'jeu_suppression', requirements: ['id' => '\d+'])]
    public function supprimerJeu(int $id, Request $request, EntityManagerInterface $em, JeuRepository $jeuRepository): Response
    {
        $jeu = $jeuRepository->find($id);
        if (!$jeu) {
            throw $this->createNotFoundException('Jeu introuvable.');
        }
        if($this->isCsrfTokenValid(
            'delete' . $jeu->getId(),
            $request->request->get('_token')
        )) {
            $em->remove($jeu);
            $em->flush();
        }
        return $this->redirectToRoute('app_jeu');
    }
    
}
