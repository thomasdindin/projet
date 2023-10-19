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

        $rayons = $rayonRepository->findAll();
        return $this->render('header/index.html.twig', [
            'controller_name' => 'HeaderController',
            'rayons' => $rayons
        ]);
    }
}
