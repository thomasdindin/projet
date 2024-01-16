<?php

namespace App\Controller;

use App\Repository\RayonRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HeaderController extends AbstractController
{
    #[Route('/header', name: 'app_header')]
    public function index(RayonRepository $rayonRepository): Response
    {
        // On passe les rayons en paramètre pour les afficher dans le header, comme ça on a pas besoin de les passer dans chaque controller
       $rayons = $rayonRepository->findAll();
        return $this->render('partials/_header.html.twig', [
            'controller_name' => 'HeaderController',
            'rayons' => $rayons
        ]);
    }
}
