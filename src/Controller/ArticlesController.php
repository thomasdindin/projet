<?php

namespace App\Controller;

use App\Entity\Produits;
use App\Form\ArticleType;
use App\Repository\ProduitsRepository;
use App\Repository\RayonRepository;
use App\Services\PanierService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ArticlesController extends AbstractController
{
    #[Route('/', name: 'app_articles')]
    public function index(ProduitsRepository $produits, RayonRepository $rayons): Response
    {
        return $this->render('articles/articles.html.twig', [
            'controller_name' => 'Tous les articles',
            'produits' => $produits->findAll(),
            'rayons' => $rayons->findAll()
        ]);
    }


    #[Route('/article/{id}', name: 'article_details')]
    public function details(Produits $produit, ProduitsRepository $produitsRepository, Request $request): Response
    {
        $taillesDispo = $produitsRepository->taillesDisponible();
        // on crée un tableau contenant les tailles disponible comme ca on a pas de double tableau
        foreach ($taillesDispo as $tabTaille) {
            foreach ($tabTaille as $taille) {
                $tableauDesTailles[$taille] = $taille;
            }
        }

        $form = $this->createForm(ArticleType::class, [], [
            'taillesDispo' => $tableauDesTailles,
        ]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $taille = $data['taille'];
            $quantite = $data['quantite'];
            // $panierService->ajoutProduit($produit);
            // return $this->redirectToRoute('', [], Response::HTTP_SEE_OTHER);
        }


        return $this->render('articles/details.html.twig', [

            'form' => $form,
            'tailles_dispo' => $produitsRepository->taillesDisponible(),
            'produit' => $produit,
        ]);
    }



    #[Route('/articles/{filtre}', name: 'app_articles_filtre')]
    public function showArticleFiltre(string $filtre, RayonRepository $rayons, ProduitsRepository $produits): Response
    {
        return $this->render('articles/articles.html.twig', [
            'controller_name' => 'ArticlesControlle',
            'filtre' => $filtre,
            'rayons' => $rayons->findAll(),
            'produits' => $produits->findAll()
        ]);
    }
}