<?php

namespace App\Controller;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProfilController extends AbstractController
{
    #[Route('/profil', name: 'app_profil')]
    public function index(UserRepository $userRepository): Response
    {

        $users = $userRepository->findAll();
        $id = $this->getUser()->getId();
        return $this->render('profil/index.html.twig', [
            'controller_name' => 'ProfilController',
            'users' => $users->findOneBy(['id' => $id]),
            //$users[$id]
        ]);


    }
}