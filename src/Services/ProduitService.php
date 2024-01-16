<?php
namespace App\Services;

use App\Entity\Produits;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Mapping\Entity;

class ProduitService
{

    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

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

    public function getAllQteEntrepot()
    {
        $qb = $this->entityManager->createQueryBuilder();
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
    // création fonction qui soustrait la quantité demandé des entrepot et renvoie l'adresse du premier entrepot

    public function soustractionQntCommande(int $qnt, int $produitid): ?int
    {

        $qb = $this->entityManager->createQueryBuilder();
        $qb->select('IDENTITY(e.fkEntrepot) as entrepotId', 'SUM(e.quantite) as totalQuantite')
            ->from('App\Entity\Existe', 'e')
            ->where('e.fkProduit = :produitid')
            ->groupBy('e.fkEntrepot')
            ->having('totalQuantite >= :qnt')
            ->orderBy('totalQuantite', 'DESC')
            ->setParameter('produitid', $produitid)
            ->setParameter('qnt', $qnt);

        $query = $qb->getQuery();
        $result = $query->getResult();

        foreach ($result as $value) {
            $entrepotId = $value['entrepotId'];
            $quantiteDisponible = $value['totalQuantite'];

            $up = $this->entityManager->createQueryBuilder();
            if ($quantiteDisponible >= $qnt) {

                $up->update('App\Entity\Existe', 'e')
                    ->set('e.quantite', $quantiteDisponible - $qnt)
                    ->where('e.fkProduit = :produitid')
                    ->andWhere('e.fkEntrepot= :entrepotId')
                    ->setParameter('produitid', $produitid)
                    ->setParameter('entrepotId', $entrepotId)
                    ->getQuery()
                    ->execute();
            } else {
                $up->update('App\Entity\Existe', 'e')
                    ->set('e.quantite', 0)
                    ->where('e.fkProduit = :produitid')
                    ->andWhere('e.fkEntrepot = :entrepotId')
                    ->setParameter('produitid', $produitid)
                    ->setParameter('entrepotId', $entrepotId)
                    ->getQuery()
                    ->execute();
                $qnt -= $quantiteDisponible;
            }

            return $entrepotId;
        }

        return null;
    }



}

?>