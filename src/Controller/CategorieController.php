<?php

namespace App\Controller;

use App\Repository\RayonRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CategorieController extends AbstractController
{
    #[Route('/categorie/{id}', name: 'app_categorie')]
    public function index(int $id, RayonRepository $rayonRepository): Response
    {
        $rayon = $rayonRepository->find($id);

        $inRange = [];
        // $min = $_GET['min'] ?? 0;
        // $max = ($_GET['max'] ?? 100) ? null : 100 ;
        if(isset($_GET['min'])) $min = $_GET['min'];
        else $min = 0;
        if(isset($_GET['max'])) $max = $_GET['max'];
        else $max = 100;
        foreach ($rayon-> getProduits() as $produit) {
            if ($produit->getPrix() >= $min && $produit->getPrix() <= $max) {
                $inRange[] = $produit;
            }
        }

        return $this->render('categorie/index.html.twig', [
            'controller_name' => 'CategorieController',
            'rayon' => $rayon,
            'inRange' => $inRange,
            'min' => $min,
            'max' => $max
        ]);
    }
}
