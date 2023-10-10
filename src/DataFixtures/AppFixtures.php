<?php


namespace App\DataFixtures;

use App\Entity\User;
use App\Entity\Rayon;
use App\Entity\Produits;
use App\Entity\Entrepot;
use App\Entity\Magasin;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $rayons = [
            'Football', 'Basketball', 'Tennis', 'Rugby', 'Natation',
            'Athlétisme', 'Volleyball', 'Badminton', 'Baseball', 'Hockey'
        ];

        // Création de 3 entrepôts fictifs
        for ($i = 1; $i <= 3; $i++) {
            $entrepot = new Entrepot();
            $entrepot->setAdresse("Adresse de l'entrepot {$i}");
            $entrepot->setVille("Ville{$i}");
            $entrepot->setCodePostal(rand(10000, 99999));
            $manager->persist($entrepot);
        }
        
        // Création de 3 magasins fictifs
        for ($i = 1; $i <= 3; $i++) {
            $magasin = new Magasin();
            $magasin->setAdresse("Adresse du magasin {$i}");
            $magasin->setVille("VilleM{$i}");
            $magasin->setCodePostal(rand(10000, 99999));
            $manager->persist($magasin);
        }

        
        // Création de rayons fictifs
        foreach ($rayons as $key => $rayonName) {
            $rayon = new Rayon();
            $rayon->setNom($rayonName);
            $manager->persist($rayon);
            $this->addReference('rayon-'.$key, $rayon);
        }
        $manager->flush();

        // Produits Fixtures
        for ($i = 1; $i <= 200; $i++) {
            $produit = new Produits();
            $produit->setNom("Produit $i");
            $produit->setTaille("M");
            $produit->setPrix(rand(10, 100));
            $produit->setDescription("Description du produit $i");
            $produit->setRayonId($this->getReference('rayon-' . rand(0, count($rayons)-1))); // Utiliser une référence pour définir la relation

            $manager->persist($produit);
        }

        $manager->flush();
    }
}
