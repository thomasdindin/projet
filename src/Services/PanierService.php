<?php

namespace App\Services;

use Symfony\Component\HttpFoundation\Session\SessionInterface;
use App\Entity\Produits;
use App\Repository\ProduitsRepository;

class PanierService
{
    //fonction ajout produit au panier qui renvoie un objet de type produit et une quantité

    public function ajoutProduit($id, $quantite, $session)
    {
        $panier = $session->get('panier', []); // récupération du panier stocké dans la session sinon panier vide 
        $panier[$id] = $quantite;
        if (!isset($panier['TVA'])) {
            $panier['TVA'] = 0.2;
        }
        $session->set('panier', $panier);
    }

    public function calculSousTotal(ProduitsRepository $produitsRepository, $session): float
    {
        $panier = $session->get('panier');
        $sousTotal = 0.0;
        foreach ($panier as $produitId => $quantite) {
            $produit = $produitsRepository->find($produitId);
            $prix = $produit->getPrix();
            $sousTotal += $prix;
        }
        return $sousTotal;
    }

    public function calculTotal($sousTotal, $session): float
    {
        $panier = $session->get('panier');
        return $panier['TVA'] * $sousTotal;
    }

    public function getContenuPanier($session): array
    {
        return $session->get('panier', []);
    }

}

?>