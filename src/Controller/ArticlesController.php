<?php

namespace App\Controller;

use App\Repository\CategoriesRepository;
use App\Repository\ProduitsRepository;
use App\Repository\RayonRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ArticlesController extends AbstractController
{
    #[Route('/', name: 'app_articles')]
    public function index(ProduitsRepository $produits, RayonRepository $rayons): Response
    {
        return $this->render('articles/articles.html.twig', [
            'controller_name' => 'Tous les articles',
            'produits' => $produits->findAll(),
            'rayons' => $rayons->findAll()
        ]);
    }

    #[Route('/article/{id}', name: 'article_details')]
    public function deatils(int $id, ProduitsRepository $produits): Response
    {
        return $this->render('articles/details.html.twig', [
            'produit' => $produits->find($id),
        ]);
    }

    #[Route('/articles/{filtre}', name: 'app_articles_filtre')]
    public function showArticleFiltre(string $filtre, RayonRepository $rayons, ProduitsRepository $produits): Response
    {
        return $this->render('articles/articles.html.twig', [
            'controller_name' => 'ArticlesControlle',
            'filtre' => $filtre,
            'rayons' => $rayons->findAll(),
            'produits' => $produits->findAll()
        ]);
    }
}