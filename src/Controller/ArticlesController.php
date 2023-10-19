<?php

namespace App\Controller;

use App\Entity\Produits;
use App\Form\ArticleType;
use App\Repository\ProduitsRepository;
use App\Repository\RayonRepository;
use App\Services\PanierService;
use App\Services\ProduitService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ArticlesController extends AbstractController
{
    #[Route('/', name: 'app_articles')]
    public function index(ProduitsRepository $produits, RayonRepository $rayons,  ProduitService $produitService): Response
    {

        $research = $_GET['research'] ?? null;
        $articles = $produits->findAll();
        $categories = $rayons->findAll();

        if ($research) {
            $articles = $produits->findBy(['nom' => $research, 'description' => $research]);
            $categories = $rayons->findByResearch($research);
        }

        $articles_qte = []; // Tableau associatif

        foreach ($articles as $art) {
            $quantite = $produitService->quantiteEntrepot($art);
            $articles_qte[$art->getId()] = $quantite;
        }

        return $this->render('articles/articles.html.twig', [
            'controller_name' => 'Tous les articles',
            'produits' => $articles,
            'rayons' => $categories,
            'articles_qte' => $articles_qte
        ]);
    }

    #[Route('/article/{id}', name: 'article_details')]
    public function details(Produits $produit, int $id, ProduitsRepository $produitsRepository, Request $request, PanierService $panierService, ProduitService $produitService): Response
    {
        // $produitDansEntrepot = $produit->getExistes(); //tableau associatif
        $quantiteDansEntrepot = $produitService->quantiteEntrepot($produit);
        // foreach ($produitDansEntrepot as $existe) {
        //     $quantiteDansEntrepot += $existe->getQuantite();
        // }

        $nbArticlesMagasin = $produitService->produitMagasins($produit); //tableau associatif
        // foreach ($produitDansMagasin as $stock) {
        //     $magasin = $stock->getFkMagasinId();
        //     $adresse = $magasin->getAdresse() . ' ' . $magasin->getVille() . ' ' . $magasin->getCodePostal();
        //     $nbArticlesMagasin[$adresse] = $stock->getQuantite();
        // }

        $form = $this->createForm(ArticleType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $quantite = $data['quantite'];
            $session = $request->getSession();
            $panierService->ajoutProduit($id, $quantite, $session);
            return $this->redirectToRoute('app_panier');
        }


        return $this->render('articles/details.html.twig', [

            'form' => $form,
            'produit' => $produit,
            'maxQuantite' => $quantiteDansEntrepot,
            'ArticlesMagasins' => $nbArticlesMagasin,
        ]);
    }
}