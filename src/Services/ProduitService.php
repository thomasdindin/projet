<?php
namespace App\Services;

use App\Entity\Produits;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Mapping\Entity;

class ProduitService
{
    /**
     * Renvoie la qté de produit dans tous les entrepots
     * @param Produits $produit
     * @return int
     */
    public function quantiteEntrepot(Produits $produit): int
    {
        $produitDansEntrepot = $produit->getExistes(); //tableau associatif
        $quantiteDansEntrepot = 0;
        foreach ($produitDansEntrepot as $existe) {
          $quantiteDansEntrepot += $existe->getQuantite();
        }
        return $quantiteDansEntrepot;
    }

    /**
     * Renvoie la qté de produit dans tous les magasins
     */
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

    /**
     * Renvoie la qté de produit dans tous les entrepots
     * @param Produits $produit
     * @return array
     */
    public function getAllQteEntrepot(EntityManagerInterface $entityManager) {
        $qb = $entityManager->createQueryBuilder();
        $qb->select('IDENTITY(existe.fkProduit) as produitId', 'SUM(existe.quantite) as quantite')
            ->from('App\Entity\Existe', 'existe')
            ->groupBy('existe.fkProduit');
        $query = $qb->getQuery();
        $result = $query->getResult();

        $qteEntrepot = [];
        foreach ($result as $key => $value) {
            $qteEntrepot[$value['produitId']] = $value['quantite'];
        }

        return $qteEntrepot;
    }


}

?>