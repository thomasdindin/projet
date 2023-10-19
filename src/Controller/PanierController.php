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
        var_dump($panier);
        return $this->render('panier/panier.html.twig', [
            'controller_name' => 'PanierController',
            // 'contenu_panier' => $panier,
        ]);
    }
}