<?php

namespace App\Services;

use Symfony\Component\HttpFoundation\Session\SessionInterface;
use App\Entity\Produits;

class PanierService
{
    private $session;

    public function __construct(SessionInterface $session)
    {
        $this->$session = $session;
    }

    //fonction ajout produit au panier qui renvoie un objet de type produit et une quantité

    public function ajoutProduit($produitId, $quantite)
    {
        $panier = $this->session->get('panier', []); // récupération du panier stocké dans la session sinon panier vide 
        $panier[$produitId] = $quantite;
        $this->session->set('panier', $panier);
    }

    // public function calcul

}

?>