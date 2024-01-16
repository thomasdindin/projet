<?php

namespace App\Controller;

use App\Entity\Entrepot;
use App\Repository\EntrepotRepository;
use App\Repository\ExisteRepository;
use App\Repository\ProduitsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LogistiqueController extends AbstractController
{
    /**
     * Affiche les entrepots
     * @Route("/logistique", name="logistique")
     * @param EntrepotRepository $entrepotRepository : repository pour les entrepots
     * @return Response
     */
    #[Route('/logistique', name: 'app_logistique')]
    public function index(EntrepotRepository $entrepotRepository): Response
    {
        return $this->render('logistique/index.html.twig', [
            'controller_name' => 'LogistiqueController',
            'entrepots'=>$entrepotRepository->findAll()
        ]);
    }

    /**
     * Affiche les produits d'un entrepot
     * @Route("/logistique/entrepot_{id}", name="logistique_entrepot")
     * @param int $id id de l'entrepot
     * @param ExisteRepository $existeRepository : repository pour les existes
     * @param EntrepotRepository $entrepotRepository : repository pour les entrepots
     * @return Response
     */
    #[Route('/logistique/entrepot_{id}', name: 'app_logistique_entrepot')]
    public function show(int $id, ExisteRepository $existeRepository, EntrepotRepository $entrepotRepository): Response
    {
        
        $queryBuilder = $existeRepository->createQueryBuilder('e');

        // On récupère la quantité dans un entrepot : 
        $queryBuilder->select('SUM(e.quantite) AS quantite')
        ->addSelect('p.nom')
        ->addSelect('p.prix')
        ->addSelect('p.id AS idProduit')
        ->join('e.fkProduit', 'p') // Utilisation de fkProduit au lieu de produit
        ->where('e.fkEntrepot = :fkEntrepotId') // Utilisation de fkEntrepot au lieu de entrepot
        ->setParameter('fkEntrepotId', $id)
        ->groupBy('e.fkProduit')
        ->addGroupBy('p.nom')
        ->addGroupBy('p.prix');

        $entrepot = $entrepotRepository->find($id);


        $query = $queryBuilder->getQuery();
        $results = $query->getResult();


        $entrepot = $entrepotRepository->find($id);
        if (!$entrepot) {
            throw $this->createNotFoundException(
                'No product found for id '.$id
            );
        }

        $items = $entrepot->getExistes();


        return $this->render('logistique/entrepot.html.twig', [
            'controller_name' => 'LogistiqueController',
            'entrepot'=>$entrepot,
            'items'=>$results
        ]);
    }

    #[Route('/logistique/produit_{idProduit}', name: 'app_logistique_produit')]
    public function showProduit(int $idProduit, ExisteRepository $existeRepository, ProduitsRepository $produitsRepository): Response
    {
        
        $queryBuilder = $existeRepository->createQueryBuilder('e');
        $queryBuilder->select('DISTINCT entrepot.ville')
        ->addSelect('e.quantite')
        ->join('e.fkProduit', 'p') // Remplacez par le nom réel de votre propriété
        ->join('e.fkEntrepot', 'entrepot') // Remplacez par le nom réel de votre propriété
        ->where('p.id = :produitId') // Remplacez par le nom réel de votre propriété
        ->setParameter('produitId', $idProduit);

        $query = $queryBuilder->getQuery();
        $results = $query->getResult();

        $produit = $produitsRepository->find($idProduit);
        if (!$produitsRepository) {
            throw $this->createNotFoundException(
                'No product found for id '.$idProduit
            );
        }


        return $this->render('logistique/produit.html.twig', [
            'controller_name' => 'LogistiqueController',
            'entrepots'=>$results,
            'produit'=>$produit
        ]);
    }
}
