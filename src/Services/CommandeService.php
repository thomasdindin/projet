<?php

namespace App\Services;

use App\Entity\Commande;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;

class CommandeService
{

    public function EnregistrementCommande($session, PanierService $panierService, EntityManagerInterface $manager)
    {
        $panier = $panierService->getContenuPanier($session);
        if (isset($panier)) {
            $commande = new Commande();
            $commande->setEtat("Commande prise en charge");
            $commande->setAdresseLiv("24 cité Lebrun");
            $commande->setCodePostal(59300);
            $commande->setVilleLiv("Valenciennes");
            $id = $session->getUser()->getId();
            $user = $manager->getRepository(User::class)->find($id);
            $commande->setFkUserId($user);
            $manager->persist($commande);
        }

        $manager->flush();
    }
}
