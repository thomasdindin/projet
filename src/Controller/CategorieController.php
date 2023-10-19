<?php

namespace App\Controller;

use App\Repository\RayonRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Services\ProduitService;

class CategorieController extends AbstractController
{
    #[Route('/categorie/{id}', name: 'app_categorie')]
    public function index(int $id, RayonRepository $rayonRepository, ProduitService $produitService): Response
    {
        $rayon = $rayonRepository->find($id);
        $allRayon = $rayonRepository->findAll();
        $checkedCategories = $_GET['categories'] ?? $rayon->getNom();

        $rayons = $rayonRepository->createQueryBuilder('r')
                ->where('r.nom IN (:categories)')
                ->setParameter('categories', $checkedCategories)
                ->getQuery()
                ->getResult();
        
        $inRange = [];

        if(isset($_GET['min'])) $min = $_GET['min'];
        else $min = 0;
        if(isset($_GET['max'])) $max = $_GET['max'];
        else $max = 100;

        foreach ($rayons as $elt){
            foreach ($elt->getProduits() as $produit) {
                if ($produit->getPrix() >= $min && $produit->getPrix() <= $max) {
                    $inRange[] = $produit;
                }
            }
        }
        if (isset($_GET['sort']) && $_GET['sort'] != 'none')
        switch ($_GET['sort']) {
            case 'asc' :
                usort($inRange, function($a, $b) {
                    return strcmp($a->getPrix(), $b->getPrix());
                });
                break;
            case 'desc' :
                usort($inRange, function($a, $b) {
                    return strcmp($b->getPrix(), $a->getPrix());
                });
                break;
            default :
                break;
        };

        $articles_qte = []; // Tableau associatif

        foreach ($inRange as $art) {
            $quantite = $produitService->quantiteEntrepot($art);
            $articles_qte[$art->getId()] = $quantite;
        }


        return $this->render('categorie/index.html.twig', [
            'controller_name' => 'CategorieController',
            'rayon' => $rayon,
            'allRayons' => $allRayon,
            'checkedCategories' => $checkedCategories,
            'inRange' => $inRange,
            'articles_qte' => $articles_qte,
            'min' => $min,
            'max' => $max
        ]);
    }
}
