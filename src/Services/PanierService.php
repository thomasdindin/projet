<?php

namespace App\Services;

use Symfony\Component\HttpFoundation\Session\SessionInterface;

class PanierService
{
    private $session;

    public function __construct(SessionInterface $session)
    {
        $this->$session = $session;
    }

    //fonction ajout produit au panier qui renvoie un objet de type produit et une quantité
    //fonction crenvoyant prix, quantite,
    //

}

?>