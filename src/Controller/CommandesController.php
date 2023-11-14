<?php

namespace App\Controller;

use App\Entity\Commande;
use App\Entity\User;
use App\Services\PanierService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CommandesController extends AbstractController
{
    #[Route('/commandes', name: 'app_commandes')]
    public function index(): Response
    {

        return $this->render('commandes/index.html.twig', [
            'controller_name' => 'CommandesController',
        ]);
    }

    #[Route('/commandesEnCours', name: 'commandes_en_cours')]
    public function commandesEnCours(Request $request, PanierService $panierService, EntityManagerInterface $manager): Response
    {
        $session = $request->getSession();
        $panier = $panierService->getContenuPanier($session);
        if (isset($panier)) {
            $commande = new Commande();
            $commande->setEtat("L");
            $commande->setAdresseLiv("24 cité Lebrun");
            $commande->setCodePostal(59300);
            $commande->setVilleLiv("Valenciennes");
            $id = $session->getId();
            $user = $manager->getRepository(User::class)->find($id);
            var_dump($user);
            $commande->setFkUserId($user);
            $manager->persist($commande);
        }

        $manager->flush();
        return $this->render('commandes/enCours.html.twig', [
            'controller_name' => 'Commandes en cours Controller',
        ]);
    }
}
