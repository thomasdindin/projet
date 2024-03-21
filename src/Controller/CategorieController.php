<?php

namespace App\Controller;

use App\Repository\RayonRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Services\ProduitService;

/**
 * Responsable de l'affichage d'une ou plusieurs catégories selon les filtres.
 */
class CategorieController extends AbstractController
{

    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * Affiche les produits d'une catégorie selon les filtres.
     * @param int $id id de la catégorie, aka le rayon
     * @param RayonRepository $rayonRepository : repository pour les rayons
     * @param ProduitService $produitService : service pour les produits
     * @return Response : la page de la catégorie
     */
    #[Route('/categorie/{id}', name: 'app_categorie')]
    public function index(int $id, RayonRepository $rayonRepository, ProduitService $produitService): Response
    {
        // On retrouve les rayons séléctionnés : 
        $rayon = $rayonRepository->find($id);
        $allRayon = $rayonRepository->findAll();
        $checkedCategories = $_GET['categories'] ?? $rayon->getNom();

        $rayons = $rayonRepository->createQueryBuilder('r')
            ->where('r.nom IN (:categories)')
            ->setParameter('categories', $checkedCategories)
            ->getQuery()
            ->getResult();

        $inRange = [];

        // On vérifie si les filtres de prix sont présents, sinon on les initialise à 0 et 100
        if (isset ($_GET['min']))
            $min = $_GET['min'];
        else
            $min = 0;
        if (isset ($_GET['max']))
            $max = $_GET['max'];
        else
            $max = 100;

        // On récupère les produits de chaque rayon, et on les ajoute à la liste des produits dans la fourchette de prix
        foreach ($rayons as $elt) {
            foreach ($elt->getProduits() as $produit) {
                if ($produit->getPrix() >= $min && $produit->getPrix() <= $max) {
                    $inRange[] = $produit;
                }
            }
        }

        // On trie les produits selon le prix
        if (isset ($_GET['sort']) && $_GET['sort'] != 'none')
            switch ($_GET['sort']) {
                case 'asc':
                    usort($inRange, function ($a, $b) {
                        return strcmp($a->getPrix(), $b->getPrix());
                    });
                    break;
                case 'desc':
                    usort($inRange, function ($a, $b) {
                        return strcmp($b->getPrix(), $a->getPrix());
                    });
                    break;
                default:
                    break;
            }
        ;

        // On récupère les quantités de chaque produit dans l'entrepôt
        $articles_qte = $produitService->getAllQteEntrepot();

        // Et enfin on fait l'affichage de la page
        return $this->render('categorie/index.html.twig', [
            'controller_name' => 'CategorieController',
            'rayonSelected' => $rayon,
            'allRayons' => $allRayon,
            'checkedCategories' => $checkedCategories,
            'inRange' => $inRange,
            'articles_qte' => $articles_qte,
            'min' => $min,
            'max' => $max
        ]);
    }
}
