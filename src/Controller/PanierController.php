<?php

namespace App\Controller;

use App\Entity\Commande;
use App\Form\CommandeType;
use App\Services\PanierService;
use App\Services\ProduitService;
use App\Repository\CommandeRepository;
use App\Repository\EntrepotRepository;
use App\Repository\ProduitsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Repository\ContenirRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PanierController extends AbstractController
{
    #[Route('/panier', name: 'app_panier')]
    public function index(PanierService $panierService, Request $request, EntityManagerInterface $em, ProduitService $produitService, ContenirRepository $contenirRepository, ProduitsRepository $produitRepository, CommandeRepository $commandeRepository, EntrepotRepository $entrepotRepository): Response
    {
        $session = $request->getSession();
        $panier = $panierService->getContenuPanier($session);
        $nbArticles = 0;
        $totalPanierSansTVA = 0;
        if (!empty($panier)) {
            $TVA = $panier['TVA'];
            $panierSansTVA = $panier;
            unset($panierSansTVA['TVA']);
            foreach ($panierSansTVA as $articles => $article) {
                if (is_array($article)) {
                    // Si l'élément est un tableau associatif, c'est un produit
                    $nbArticles += $article['quantite'];
                    $totalPanierSansTVA += $article['prix'] * $article['quantite'];
                } else {
                    // Sinon, c'est un nombre entier (dans ce cas, 3)
                    $nbArticles += $article;
                    $totalPanierSansTVA += $article['prix'] * $article['quantite'];
                }
            }
        } else {
            $TVA = 0;
            $panierSansTVA = [];
        }

        $commande = new Commande();
        $commande->setFkUserId($this->getUser());
        $commande->setEtat("Prise en compte");
        $form = $this->createForm(CommandeType::class, $commande);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $commande = $form->getData();

            $em->persist($commande);
            $em->flush();
            //enregistrer dans contenir fkproduitid = $art et fk_commande_id je recupere le dernier enregistrement dand la table commande fk_entrepot_id renvoyé par la fonction soustractionQntCommande quantite = $val['quantite'] tva=$TVA et prix_unitaire=$art['id']['prix']
            foreach ($panierSansTVA as $art => $val) {
                $entrepotId = $produitService->soustractionQntCommande($val['quantite'], $art);

                $fkProduitId = $art;
                $fkCommandeId = $commande->getId();
                $quantite = $val['quantite'];
                $tva = $TVA;
                $prixUnitaire = $val['prix'];

                $produit = $produitRepository->getProduitById($fkProduitId);
                $entrepot = $entrepotRepository->getEntrepotById($entrepotId);

                // Vérifiez si les objets sont valides avant d'ajouter les enregistrements
                if ($produit && $commande && $entrepot) {
                    $contenirRepository->addContenirRecords($produit, $commande, $entrepot, $quantite, $tva, $prixUnitaire);
                } else {
                    // Gérez le cas où l'un des objets n'est pas trouvé
                    echo "Erreur : Impossible de trouver un ou plusieurs objets.";
                }
            }
            return $this->redirectToRoute('app_commandes');
        }

        return $this->render('panier/panier.html.twig', [
            'contenu_panier' => $panierSansTVA,
            'TVA' => $TVA,
            'nb_articles' => $nbArticles,
            'totalPanierSansTVA' => $totalPanierSansTVA,
            'form' => $form
        ]);
    }

}