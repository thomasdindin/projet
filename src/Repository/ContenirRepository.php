<?php

namespace App\Repository;

use App\Entity\Contenir;
use App\Entity\Entrepot;
use App\Entity\Produits;
use App\Entity\Commande;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Contenir>
 *
 * @method Contenir|null find($id, $lockMode = null, $lockVersion = null)
 * @method Contenir|null findOneBy(array $criteria, array $orderBy = null)
 * @method Contenir[]    findAll()
 * @method Contenir[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ContenirRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Contenir::class);
    }


    public function addContenirRecords(Produits $fkProduitId, Commande $fkCommandeId, Entrepot $fkEntrepotId, $quantite, $tva, $prixUnitaire)
    {
        $entityManager = $this->getEntityManager();

        $contenir = new Contenir();
        $contenir->setFkProduitId($fkProduitId);
        $contenir->setFkCommandeId($fkCommandeId);
        $contenir->setFkEntrepotId($fkEntrepotId);
        $contenir->setQuantite($quantite);
        $contenir->setTva($tva);
        $contenir->setPrixUnitaire($prixUnitaire);

        $entityManager->persist($contenir);
        $entityManager->flush();
    }

    /**
     * Récupère le contenu d'une commande spécifique.
     *
     * @param Commande $commande La commande pour laquelle récupérer le contenu.
     * @return Contenir[] Un tableau d'objets Contenir.
     */
    public function getContenuCommandes(Commande $commande): array
    {
        return $this->findBy(['fkCommande' => $commande]);
    }
    //    /**
//     * @return Contenir[] Returns an array of Contenir objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('c.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

    //    public function findOneBySomeField($value): ?Contenir
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
