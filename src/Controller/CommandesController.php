<?php

namespace App\Controller;

use App\Entity\Commande;
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
        // cette vue contiendra toutes les commandes passées avec leurs détails et état

        return $this->render('commandes/index.html.twig', [
            'controller_name' => 'CommandesController',
        ]);
    }

}
