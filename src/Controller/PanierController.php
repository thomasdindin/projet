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
        if (isset($panier)) {
            $TVA = $panier['TVA'];
            $panierSansTVA = $panier;
        }

        unset($panierSansTVA['TVA']);
        $nbArticles = 0;
        $totalPanierSansTVA = 0;
        foreach ($panierSansTVA as $articles => $article) {
            if (is_array($article)) {
                // Si l'élément est un tableau associatif, c'est un produit
                $nbArticles += $article['quantite'];
                $totalPanierSansTVA += $article['prix'] * $article['quantite'];
            } else {
                // Sinon, c'est un nombre entier (dans ce cas, 3)
                $nbArticles += $article;
                $totalPanierSansTVA += $article['prix'] * $article['quantite'];
            }
        }
        var_dump($panierSansTVA);
        // var_dump($totalPanier);
        // var_dump($nbArticles);
        // var_dump($TVA);
        return $this->render('panier/panier.html.twig', [
            'contenu_panier' => $panierSansTVA,
            'TVA' => $TVA,
            'nb_articles' => $nbArticles,
            'totalPanierSansTVA' => $totalPanierSansTVA,
        ]);
    }
}