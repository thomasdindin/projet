<?php

namespace App\Controller;

use App\Repository\CategoriesRepository;
use App\Repository\ProduitsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ArticlesController extends AbstractController
{
    #[Route('/', name: 'app_articles')]
    public function index(ProduitsRepository $produits, CategoriesRepository $categories): Response
    {
        return $this->render('articles/articles.html.twig', [
            'controller_name' => 'Tous les articles',
            'produits' => $produits->findAll(),
            'categories' => $categories->findAll()
        ]);
    }

    #[Route('/articles/{id}', name: 'article_details')]
    public function deatils(int $id, ProduitsRepository $produits): Response
    {
        return $this->render('articles/details.html.twig', [
            'produit' => $produits->find($id),
        ]);
    }

    #[Route('/articles/{filtre}', name: 'app_articles_filtre')]
    public function showArticleFiltre(string $filtre, CategoriesRepository $categories, ProduitsRepository $produits): Response
    {
        return $this->render('articles/articles.html.twig', [
            'controller_name' => 'ArticlesControlle',
            'filtre' => $filtre,
            'categories' => $categories->findAll(),
            'produits' => $produits->findAll()
        ]);
    }
}