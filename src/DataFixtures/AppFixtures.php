<?php

namespace App\DataFixtures;

use App\Entity\Categories;
use App\Entity\Produits;
use App\Repository\CategoriesRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {

        //     $categorie = new Categories();
        //     $categorie->setId(1);
        //     $categorieBas = new Categories();
        //     $categorieBas->setCatégories("Bas");
        //     $categorieChau = new Categories();
        //     $categorieChau->setCatégories("haut");
        //     for ($i = 0; $i < 50; $i++) {
        //         $produit = new Produits();
        //         $produit->setNom("produit" . $i)
        //             ->setDescription(array_rand(["Chaussure de sport", "Haut zumba", "Robe danse", "Pantalon rando"], 1))
        //             ->setPrix(mt_rand(5, 300))
        //             ->setTaille(array_rand(["XS", "S", "M", "L", "XL"], 1))
        //             ->setSexe(array_rand(["H", "F", "E"]))
        //             ->setImage("Image" . $i)
        //             ->setFkIdCategorie(array_rand([$idCat, $categorieBas . getId(), $categorieChau . getId()]))
        //             ->setSexe('H');

        //     }

        $manager->flush();
    }
}