<?php

namespace App\Controller;

use App\Entity\Commande;
use App\Repository\CommandeRepository;
use App\Repository\ContenirRepository;
use App\Services\PanierService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;


class CommandesController extends AbstractController
{
    #[Route('/commandes', name: 'app_commandes')]
    public function index(CommandeRepository $cmdRepo, ContenirRepository $contenirRepo, SessionInterface $session): Response
    {
        // cette vue contiendra toutes les commandes passées avec leurs détails et état 
        if ($session->has('panier')) {
            // Supprimer la variable 'panier' de la session
            $session->remove('panier');
        }
        $user = $this->getUser();
        $commandes = $cmdRepo->getCommandesByUser($user);
        $contenus = [];
        foreach ($commandes as $commande) {
            // Ajoute les contenus à la liste existante au lieu de réinitialiser le tableau
            $contenus = array_merge($contenus, $contenirRepo->getContenuCommandes($commande));
        }


        return $this->render('commandes/index.html.twig', [
            'controller_name' => 'Suivi De Vos commandes',
            'commandes' => $commandes,
            'contenus' => $contenus,
        ]);
    }

}
