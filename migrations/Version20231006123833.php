<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231006123833 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE commande (id INT AUTO_INCREMENT NOT NULL, fk_user_id INT NOT NULL, etat VARCHAR(20) NOT NULL, adresse_liv VARCHAR(255) NOT NULL, code_postal INT NOT NULL, ville_liv VARCHAR(100) NOT NULL, INDEX IDX_6EEAA67D6DE8AF9C (fk_user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE contenir (id INT AUTO_INCREMENT NOT NULL, fk_produit_id INT NOT NULL, fk_commande_id INT NOT NULL, fk_entrepot_id INT NOT NULL, quantite INT NOT NULL, tva DOUBLE PRECISION NOT NULL, prix_unitaire DOUBLE PRECISION NOT NULL, INDEX IDX_3C914DFD2B928C01 (fk_produit_id), INDEX IDX_3C914DFD3322A87D (fk_commande_id), INDEX IDX_3C914DFD4BE36F9B (fk_entrepot_id
        ), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE entrepot (id INT AUTO_INCREMENT NOT NULL, adresse VARCHAR(255) NOT NULL, ville VARCHAR(100) NOT NULL, code_postal INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE existe (id INT AUTO_INCREMENT NOT NULL, fk_produit_id INT NOT NULL, fk_entrepot_id INT NOT NULL, quantite INT NOT NULL, INDEX IDX_464BD3E12B928C01 (fk_produit_id), INDEX IDX_464BD3E14BE36F9B (fk_entrepot_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE magasin (id INT AUTO_INCREMENT NOT NULL, adresse VARCHAR(255) NOT NULL, ville VARCHAR(100) NOT NULL, code_postal INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE produits (id INT AUTO_INCREMENT NOT NULL, rayon_id INT NOT NULL, nom VARCHAR(255) NOT NULL, taille VARCHAR(10) NOT NULL, prix DOUBLE PRECISION NOT NULL, description VARCHAR(255) NOT NULL, INDEX IDX_BE2DDF8C391016D9 (rayon_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE rayon (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE stocker (id INT AUTO_INCREMENT NOT NULL, fk_produit_id INT NOT NULL, fk_magasin_id INT NOT NULL, quantite INT NOT NULL, INDEX IDX_AD495D2B928C01 (fk_produit_id), INDEX IDX_AD495D4F61E5A2 (fk_magasin_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE commande ADD CONSTRAINT FK_6EEAA67D6DE8AF9C FOREIGN KEY (fk_user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE contenir ADD CONSTRAINT FK_3C914DFD2B928C01 FOREIGN KEY (fk_produit_id) REFERENCES produits (id)');
        $this->addSql('ALTER TABLE contenir ADD CONSTRAINT FK_3C914DFD3322A87D FOREIGN KEY (fk_commande_id) REFERENCES commande (id)');
        $this->addSql('ALTER TABLE contenir ADD CONSTRAINT FK_3C914DFD4BE36F9B FOREIGN KEY (fk_entrepot_id) REFERENCES entrepot (id)');
        $this->addSql('ALTER TABLE existe ADD CONSTRAINT FK_464BD3E12B928C01 FOREIGN KEY (fk_produit_id) REFERENCES produits (id)');
        $this->addSql('ALTER TABLE existe ADD CONSTRAINT FK_464BD3E14BE36F9B FOREIGN KEY (fk_entrepot_id) REFERENCES entrepot (id)');
        $this->addSql('ALTER TABLE produits ADD CONSTRAINT FK_BE2DDF8C391016D9 FOREIGN KEY (rayon_id) REFERENCES rayon (id)');
        $this->addSql('ALTER TABLE stocker ADD CONSTRAINT FK_AD495D2B928C01 FOREIGN KEY (fk_produit_id) REFERENCES produits (id)');
        $this->addSql('ALTER TABLE stocker ADD CONSTRAINT FK_AD495D4F61E5A2 FOREIGN KEY (fk_magasin_id) REFERENCES magasin (id)');
        $this->addSql('ALTER TABLE user ADD ville VARCHAR(100) DEFAULT NULL, ADD pays VARCHAR(100) DEFAULT NULL, ADD code_postal INT DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE commande DROP FOREIGN KEY FK_6EEAA67D6DE8AF9C');
        $this->addSql('ALTER TABLE contenir DROP FOREIGN KEY FK_3C914DFD2B928C01');
        $this->addSql('ALTER TABLE contenir DROP FOREIGN KEY FK_3C914DFD3322A87D');
        $this->addSql('ALTER TABLE contenir DROP FOREIGN KEY FK_3C914DFD4BE36F9B');
        $this->addSql('ALTER TABLE existe DROP FOREIGN KEY FK_464BD3E12B928C01');
        $this->addSql('ALTER TABLE existe DROP FOREIGN KEY FK_464BD3E14BE36F9B');
        $this->addSql('ALTER TABLE produits DROP FOREIGN KEY FK_BE2DDF8C391016D9');
        $this->addSql('ALTER TABLE stocker DROP FOREIGN KEY FK_AD495D2B928C01');
        $this->addSql('ALTER TABLE stocker DROP FOREIGN KEY FK_AD495D4F61E5A2');
        $this->addSql('DROP TABLE commande');
        $this->addSql('DROP TABLE contenir');
        $this->addSql('DROP TABLE entrepot');
        $this->addSql('DROP TABLE existe');
        $this->addSql('DROP TABLE magasin');
        $this->addSql('DROP TABLE produits');
        $this->addSql('DROP TABLE rayon');
        $this->addSql('DROP TABLE stocker');
        $this->addSql('ALTER TABLE user DROP ville, DROP pays, DROP code_postal');
    }
}