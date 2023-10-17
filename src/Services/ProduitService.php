<?php
namespace App\Services;

use App\Entity\Produits;

class ProduitService
{

    public function quantiteEntrepot(Produits $produit): int
    {
        $produitDansEntrepot = $produit->getExistes(); //tableau associatif
        $quantiteDansEntrepot = 0;
        foreach ($produitDansEntrepot as $existe) {
            $quantiteDansEntrepot += $existe->getQuantite();
        }
        return $quantiteDansEntrepot;
    }

    public function produitMagasins(Produits $produit): array
    {

        $nbArticlesMagasin = [];
        $produitDansMagasin = $produit->getStockers();
        foreach ($produitDansMagasin as $stock) {
            $magasin = $stock->getFkMagasinId();
            $adresse = $magasin->getAdresse() . ' ' . $magasin->getVille() . ' ' . $magasin->getCodePostal();
            $nbArticlesMagasin[$adresse] = $stock->getQuantite();
        }
        return $nbArticlesMagasin;
    }



}

?>