<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230919142206 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE commandes (id INT AUTO_INCREMENT NOT NULL, fk_id_etat_id INT NOT NULL, contient_id INT DEFAULT NULL, fk_id_user_id INT NOT NULL, date_commande DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', lieu_exp VARCHAR(255) NOT NULL, lieu_liv VARCHAR(255) NOT NULL, INDEX IDX_35D4282C23ADE51C (fk_id_etat_id), INDEX IDX_35D4282C23AEAE6E (contient_id), INDEX IDX_35D4282C899DB076 (fk_id_user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE contient (id INT AUTO_INCREMENT NOT NULL, prix_unitaire DOUBLE PRECISION NOT NULL, tva NUMERIC(5, 2) NOT NULL, quantite INT NOT NULL, adresse VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE entrepot (id INT AUTO_INCREMENT NOT NULL, stocke_id INT DEFAULT NULL, lieu VARCHAR(255) NOT NULL, INDEX IDX_D805175A8FB96863 (stocke_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE etat (id INT AUTO_INCREMENT NOT NULL, etat VARCHAR(45) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE produits (id INT AUTO_INCREMENT NOT NULL, contient_id INT DEFAULT NULL, stocke_id INT DEFAULT NULL, nom VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, prix DOUBLE PRECISION NOT NULL, image VARCHAR(255) NOT NULL, taille VARCHAR(20) NOT NULL, INDEX IDX_BE2DDF8C23AEAE6E (contient_id), INDEX IDX_BE2DDF8C8FB96863 (stocke_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE stocke (id INT AUTO_INCREMENT NOT NULL, quantite INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, nom VARCHAR(45) NOT NULL, prenom VARCHAR(45) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE commandes ADD CONSTRAINT FK_35D4282C23ADE51C FOREIGN KEY (fk_id_etat_id) REFERENCES etat (id)');
        $this->addSql('ALTER TABLE commandes ADD CONSTRAINT FK_35D4282C23AEAE6E FOREIGN KEY (contient_id) REFERENCES contient (id)');
        $this->addSql('ALTER TABLE commandes ADD CONSTRAINT FK_35D4282C899DB076 FOREIGN KEY (fk_id_user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE entrepot ADD CONSTRAINT FK_D805175A8FB96863 FOREIGN KEY (stocke_id) REFERENCES stocke (id)');
        $this->addSql('ALTER TABLE produits ADD CONSTRAINT FK_BE2DDF8C23AEAE6E FOREIGN KEY (contient_id) REFERENCES contient (id)');
        $this->addSql('ALTER TABLE produits ADD CONSTRAINT FK_BE2DDF8C8FB96863 FOREIGN KEY (stocke_id) REFERENCES stocke (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE commandes DROP FOREIGN KEY FK_35D4282C23ADE51C');
        $this->addSql('ALTER TABLE commandes DROP FOREIGN KEY FK_35D4282C23AEAE6E');
        $this->addSql('ALTER TABLE commandes DROP FOREIGN KEY FK_35D4282C899DB076');
        $this->addSql('ALTER TABLE entrepot DROP FOREIGN KEY FK_D805175A8FB96863');
        $this->addSql('ALTER TABLE produits DROP FOREIGN KEY FK_BE2DDF8C23AEAE6E');
        $this->addSql('ALTER TABLE produits DROP FOREIGN KEY FK_BE2DDF8C8FB96863');
        $this->addSql('DROP TABLE commandes');
        $this->addSql('DROP TABLE contient');
        $this->addSql('DROP TABLE entrepot');
        $this->addSql('DROP TABLE etat');
        $this->addSql('DROP TABLE produits');
        $this->addSql('DROP TABLE stocke');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
