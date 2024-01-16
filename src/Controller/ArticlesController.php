<?php

namespace App\Controller;

use App\Entity\Produits;
use App\Form\ArticleType;
use App\Repository\ProduitsRepository;
use App\Repository\RayonRepository;
use App\Services\PanierService;
use App\Services\ProduitService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class ArticlesController
 * Responsable de l'affichage des articles sur la page d'accueil et de l'affichage unique
 */
class ArticlesController extends AbstractController
{

    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/', name: 'app_articles')]
    public function index(ProduitsRepository $produits, RayonRepository $rayons, ProduitService $produitService): Response{
        $research = $_GET['research'] ?? null;
        $articles = $produits->findAll();
        $categories = $rayons->findAll();

        
        if ($research) {
            $articles = $produits->findBy(['nom' => $research, 'description' => $research]);
            $categories = $rayons->findByResearch($research);
        }

        $articles_qte = $produitService->getAllQteEntrepot($this->entityManager);

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
        $quantiteDansEntrepot = $produitService->quantiteEntrepot($produit);

        $nbArticlesMagasin = $produitService->produitMagasins($produit); //tableau associatif


        $form = $this->createForm(ArticleType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $quantite = $data['quantite'];
            $session = $request->getSession();
            $panierService->ajoutProduit($id, $quantite, $session, $produit->getPrix(), $produit->getNom());
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