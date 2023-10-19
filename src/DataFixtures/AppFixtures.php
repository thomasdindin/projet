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
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    private UserPasswordHasherInterface $hasher;

    public function __construct(UserPasswordHasherInterface $hasher)
    {
        $this->hasher = $hasher;
    }
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

        // Création des entrepôts
        for ($i = 1; $i <= 3; $i++) {
            $entrepot = new Entrepot();
            $entrepot->setAdresse("Adresse de l'entrepôt $i");
            $entrepot->setVille("Ville $i");
            $entrepot->setCodePostal(rand(10000, 99999));
            $manager->persist($entrepot);
            $this->addReference('entrepot-' . $i, $entrepot); // Ajoutez une référence pour chaque entrepôt créé
        }

        // Création des produits
        for ($x = 1; $x <= 500; $x++) {
            $produit = new Produits();
            $produit->setNom("Produit $x");
            $produit->setPrix(rand(10, 100));
            $produit->setDescription("Description du produit $x");
            $produit->setRayonId($this->getReference('rayon-' . rand(0, count($rayons) - 1))); // Utilisez une référence pour définir la relation
            $manager->persist($produit);

            // Créez des relations Produit-Entrepot avec une quantité aléatoire
            for ($i = 1; $i <= rand(1, 3); $i++) { // Vous pouvez ajuster la plage du nombre d'entrepôts
                $entrepot = $this->getReference('entrepot-' . rand(1, 3)); // Utilisez une référence pour sélectionner un entrepôt existant
                $quantite = rand(1, 10); // Vous pouvez ajuster la plage de quantité selon vos besoins

                $existe = new Existe();
                $existe->setFkEntrepotId($entrepot);
                $existe->setFkProduitId($produit);
                $existe->setQuantite($quantite);
                $manager->persist($existe);
            }
        }
        $user = new User();
        $user->setPrenom('Amanie');
        $user->setNom("Said");
        $user->setEmail('amanie@gmail.com');
        $password = $this->hasher->hashPassword($user, '123');
        $user->setPassword($password);
        $manager->persist($user);
        $manager->flush();



        $manager->flush();
    }
}
