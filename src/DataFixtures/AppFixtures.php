<?php

namespace App\DataFixtures;

use App\Entity\Categories;
use App\Entity\Produits;
use App\Repository\CategoriesRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{

    public function idCategorie(CategoriesRepository $categoriesRepository): Categories
    {
        return $categoriesRepository->find(mt_rand(1, 3));
    }
    public function load(ObjectManager $manager): void
    {

        // for ($i = 0; $i < 50; $i++) {
        //     $produit = new Produits();
        //     $produit->setNom("produit" . $i)
        //         ->setDescription(array_rand(["Chaussure de sport", "Haut zumba", "Robe danse", "Pantalon rando"], 1))
        //         ->setPrix(mt_rand(5, 300))
        //         ->setTaille(array_rand(["XS", "S", "M", "L", "XL"], 1))
        //         ->setSexe(array_rand(["H", "F", "E"]))
        //         ->setImage("Image" . $i)
        //         ->setFkIdCategorie(idCategorie(CategoriesRepository $categoriesRepository));

        // }

        $manager->flush();
    }
}