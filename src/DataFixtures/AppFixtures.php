<?php


namespace App\DataFixtures;

use App\Entity\Stocker;
use App\Entity\User;
use App\Entity\Rayon;
use App\Entity\Produits;
use App\Entity\Entrepot;
use App\Entity\Magasin;
use App\Entity\Existe;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $rayons = [
            'Football',
            'Basketball',
            'Tennis',
            'Rugby',
            'Natation',
            'Athlétisme',
            'Volleyball',
            'Badminton',
            'Baseball',
            'Hockey'
        ];

        foreach ($rayons as $key => $rayonName) {
            $rayon = new Rayon();
            $rayon->setNom($rayonName);
            $manager->persist($rayon);
            $this->addReference('rayon-' . $key, $rayon);
        }
        $manager->flush();

        // Création entrepots produits magasins stocker et existe
        for ($i = 1; $i <= 3; $i++) {
            $entrepot = new Entrepot();
            $existe = new Existe();
            $magasin = new Magasin();
            $stocker = new Stocker();
            $magasin->setAdresse("Adresse du magasin {$i}");
            $magasin->setVille("VilleM{$i}");
            $magasin->setCodePostal(rand(10000, 99999));
            $entrepot->setAdresse("Adresse de l'entrepot {$i}");
            $entrepot->setVille("Ville{$i}");
            $entrepot->setCodePostal(rand(10000, 99999));
            $manager->persist($entrepot);
            $manager->persist($magasin);
            for ($x = 1; $x <= 200; $x++) {
                $produit = new Produits();
                $produit->setNom("Produit $x");
                $produit->setPrix(rand(10, 100));
                $produit->setDescription("Description du produit $x");
                $produit->setRayonId($this->getReference('rayon-' . rand(0, count($rayons) - 1))); // Utiliser une référence pour définir la relation
                $existe->setFkEntrepotId($entrepot);
                $existe->setQuantite(5);
                $existe->setFkProduitId($produit);
                $stocker->setFkProduitId($produit);
                $stocker->setQuantite(4);
                $stocker->setFkMagasinId($magasin);
                $manager->persist($produit);
                $manager->persist($stocker);
                $manager->persist($existe);
            }
        }
        $manager->flush();



    }
}