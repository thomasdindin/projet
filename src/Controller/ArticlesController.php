<?php

namespace App\Controller;

use App\Repository\CategoriesRepository;
use App\Repository\ProduitsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ArticlesController extends AbstractController
{
    #[Route('/', name: 'app_articles_home')]
    public function showArticleFiltre(CategoriesRepository $categories, ProduitsRepository $produits): Response{
        return $this->render('articles/articles.html.twig', [
            'controller_name' => 'ArticlesController',
            'categories' => $categories->findAll(),
            'produits' => $produits->findAll()
        ]);
    }
}
