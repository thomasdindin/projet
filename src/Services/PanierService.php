<?php

namespace App\Services;

use Symfony\Component\HttpFoundation\Session\SessionInterface;
use App\Entity\Produits;
use App\Repository\ProduitsRepository;

class PanierService
{
    private $session;

    public function __construct(SessionInterface $session)
    {
        $this->$session = $session;
    }

    //fonction ajout produit au panier qui renvoie un objet de type produit et une quantité

    public function ajoutProduit($produitId, $quantite, $TVA)
    {
        $panier = $this->session->get('panier', []); // récupération du panier stocké dans la session sinon panier vide 
        $panier[$produitId] = $quantite;
        if (!isset($panier['TVA'])) {
            $panier['TVA'] = $TVA;
        }
        $this->session->set('panier', $panier);
    }

    // public function calcul total
    public function calculSousTotal(ProduitsRepository $produitsRepository): float
    {
        $panier = $this->session->get('panier');
        $sousTotal = 0.0;
        foreach ($panier as $produitId => $quantite) {
            $produit = $produitsRepository->find($produitId);
            $prix = $produit->getPrix();
            $sousTotal += $prix;
        }
        return $sousTotal;
    }

    public function calculTotal($sousTotal): float
    {
        $panier = $this->session->get('panier');
        return $panier['TVA'] * $sousTotal;
    }

    public function getContenuPanier(): array
    {
        return $this->session->get('panier', []);
    }

}

?>