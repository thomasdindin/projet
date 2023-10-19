<?php

namespace App\Controller;

use App\Services\PanierService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PanierController extends AbstractController
{
    #[Route('/panier', name: 'app_panier')]
    public function index(PanierService $panierService, Request $request): Response
    {
        $session = $request->getSession();
        $panier = $panierService->getContenuPanier($session);
        $TVA = $panier['TVA'];
        $panierSansTVA = $panier;
        unset($panierSansTVA['TVA']);
        $nbArticles = 0;
        foreach ($panierSansTVA as $articles => $article) {
            if (is_array($article)) {
                // Si l'élément est un tableau associatif, c'est un produit
                $nbArticles += $article['quantite'];
            } else {
                // Sinon, c'est un nombre entier (dans ce cas, 3)
                $nbArticles += $article;
            }
        }
        var_dump($panierSansTVA);
        var_dump($nbArticles);
        return $this->render('panier/panier.html.twig', [
            'controller_name' => 'PanierController',
            'contenu_panier' => $panierSansTVA,
            'TVA' => $TVA,
            'nb_articles' => $nbArticles,
        ]);
    }
}