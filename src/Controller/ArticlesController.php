<?php

namespace App\Controller;

use App\Repository\CategoriesRepository;
use App\Repository\ProduitsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ArticlesController extends AbstractController
{
    #[Route('/articles', name: 'app_articles')]
    public function index(): Response
    {
        return $this->render('articles/index.html.twig', [
            'controller_name' => 'ArticlesController',
        ]);
    }

    #[Route('/articles/{filtre}', name: 'app_articles_filtre')]
    public function showArticleFiltre(String $filtre, CategoriesRepository $categories, ProduitsRepository $produits): Response{
        return $this->render('articles/articles.html.twig', [
            'controller_name' => 'ArticlesController',
            'filtre' => $filtre,
            'categories' => $categories->findAll(),
            'produits' => $produits->findAll()
        ]);
    }
}
