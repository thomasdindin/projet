<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231010114441 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, nom VARCHAR(45) NOT NULL, prenom VARCHAR(45) NOT NULL, adresse VARCHAR(255) DEFAULT NULL, ville VARCHAR(100) DEFAULT NULL, pays VARCHAR(100) DEFAULT NULL, code_postal INT DEFAULT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('DROP INDEX IDX_6EEAA67D6DE8AF9C ON commande');
        $this->addSql('ALTER TABLE commande CHANGE fk_user_id fk_user_id_id INT NOT NULL');
        $this->addSql('ALTER TABLE commande ADD CONSTRAINT FK_6EEAA67D6DE8AF9C FOREIGN KEY (fk_user_id_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_6EEAA67D6DE8AF9C ON commande (fk_user_id_id)');
        $this->addSql('DROP INDEX IDX_3C914DFD2B928C01 ON contenir');
        $this->addSql('DROP INDEX IDX_3C914DFD3322A87D ON contenir');
        $this->addSql('DROP INDEX IDX_3C914DFD4BE36F9B ON contenir');
        $this->addSql('ALTER TABLE contenir ADD fk_produit_id_id INT NOT NULL, ADD fk_commande_id_id INT NOT NULL, ADD fk_entrepot_id_id INT NOT NULL, DROP fk_produit_id, DROP fk_commande_id, DROP fk_entrepot_id');
        $this->addSql('ALTER TABLE contenir ADD CONSTRAINT FK_3C914DFD2B928C01 FOREIGN KEY (fk_produit_id_id) REFERENCES produits (id)');
        $this->addSql('ALTER TABLE contenir ADD CONSTRAINT FK_3C914DFD3322A87D FOREIGN KEY (fk_commande_id_id) REFERENCES commande (id)');
        $this->addSql('ALTER TABLE contenir ADD CONSTRAINT FK_3C914DFD4BE36F9B FOREIGN KEY (fk_entrepot_id_id) REFERENCES entrepot (id)');
        $this->addSql('CREATE INDEX IDX_3C914DFD2B928C01 ON contenir (fk_produit_id_id)');
        $this->addSql('CREATE INDEX IDX_3C914DFD3322A87D ON contenir (fk_commande_id_id)');
        $this->addSql('CREATE INDEX IDX_3C914DFD4BE36F9B ON contenir (fk_entrepot_id_id)');
        $this->addSql('DROP INDEX IDX_464BD3E12B928C01 ON existe');
        $this->addSql('DROP INDEX IDX_464BD3E14BE36F9B ON existe');
        $this->addSql('ALTER TABLE existe ADD fk_produit_id_id INT NOT NULL, ADD fk_entrepot_id_id INT NOT NULL, DROP fk_produit_id, DROP fk_entrepot_id');
        $this->addSql('ALTER TABLE existe ADD CONSTRAINT FK_464BD3E12B928C01 FOREIGN KEY (fk_produit_id_id) REFERENCES produits (id)');
        $this->addSql('ALTER TABLE existe ADD CONSTRAINT FK_464BD3E14BE36F9B FOREIGN KEY (fk_entrepot_id_id) REFERENCES entrepot (id)');
        $this->addSql('CREATE INDEX IDX_464BD3E12B928C01 ON existe (fk_produit_id_id)');
        $this->addSql('CREATE INDEX IDX_464BD3E14BE36F9B ON existe (fk_entrepot_id_id)');
        $this->addSql('DROP INDEX IDX_BE2DDF8C391016D9 ON produits');
        $this->addSql('ALTER TABLE produits CHANGE rayon_id rayon_id_id INT NOT NULL');
        $this->addSql('ALTER TABLE produits ADD CONSTRAINT FK_BE2DDF8C391016D9 FOREIGN KEY (rayon_id_id) REFERENCES rayon (id)');
        $this->addSql('CREATE INDEX IDX_BE2DDF8C391016D9 ON produits (rayon_id_id)');
        $this->addSql('DROP INDEX IDX_AD495D2B928C01 ON stocker');
        $this->addSql('DROP INDEX IDX_AD495D4F61E5A2 ON stocker');
        $this->addSql('ALTER TABLE stocker ADD fk_produit_id_id INT NOT NULL, ADD fk_magasin_id_id INT NOT NULL, DROP fk_produit_id, DROP fk_magasin_id');
        $this->addSql('ALTER TABLE stocker ADD CONSTRAINT FK_AD495D2B928C01 FOREIGN KEY (fk_produit_id_id) REFERENCES produits (id)');
        $this->addSql('ALTER TABLE stocker ADD CONSTRAINT FK_AD495D4F61E5A2 FOREIGN KEY (fk_magasin_id_id) REFERENCES magasin (id)');
        $this->addSql('CREATE INDEX IDX_AD495D2B928C01 ON stocker (fk_produit_id_id)');
        $this->addSql('CREATE INDEX IDX_AD495D4F61E5A2 ON stocker (fk_magasin_id_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE commande DROP FOREIGN KEY FK_6EEAA67D6DE8AF9C');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE messenger_messages');
        $this->addSql('DROP INDEX IDX_6EEAA67D6DE8AF9C ON commande');
        $this->addSql('ALTER TABLE commande CHANGE fk_user_id_id fk_user_id INT NOT NULL');
        $this->addSql('CREATE INDEX IDX_6EEAA67D6DE8AF9C ON commande (fk_user_id)');
        $this->addSql('ALTER TABLE contenir DROP FOREIGN KEY FK_3C914DFD2B928C01');
        $this->addSql('ALTER TABLE contenir DROP FOREIGN KEY FK_3C914DFD3322A87D');
        $this->addSql('ALTER TABLE contenir DROP FOREIGN KEY FK_3C914DFD4BE36F9B');
        $this->addSql('DROP INDEX IDX_3C914DFD2B928C01 ON contenir');
        $this->addSql('DROP INDEX IDX_3C914DFD3322A87D ON contenir');
        $this->addSql('DROP INDEX IDX_3C914DFD4BE36F9B ON contenir');
        $this->addSql('ALTER TABLE contenir ADD fk_produit_id INT NOT NULL, ADD fk_commande_id INT NOT NULL, ADD fk_entrepot_id INT NOT NULL, DROP fk_produit_id_id, DROP fk_commande_id_id, DROP fk_entrepot_id_id');
        $this->addSql('CREATE INDEX IDX_3C914DFD2B928C01 ON contenir (fk_produit_id)');
        $this->addSql('CREATE INDEX IDX_3C914DFD3322A87D ON contenir (fk_commande_id)');
        $this->addSql('CREATE INDEX IDX_3C914DFD4BE36F9B ON contenir (fk_entrepot_id)');
        $this->addSql('ALTER TABLE existe DROP FOREIGN KEY FK_464BD3E12B928C01');
        $this->addSql('ALTER TABLE existe DROP FOREIGN KEY FK_464BD3E14BE36F9B');
        $this->addSql('DROP INDEX IDX_464BD3E12B928C01 ON existe');
        $this->addSql('DROP INDEX IDX_464BD3E14BE36F9B ON existe');
        $this->addSql('ALTER TABLE existe ADD fk_produit_id INT NOT NULL, ADD fk_entrepot_id INT NOT NULL, DROP fk_produit_id_id, DROP fk_entrepot_id_id');
        $this->addSql('CREATE INDEX IDX_464BD3E12B928C01 ON existe (fk_produit_id)');
        $this->addSql('CREATE INDEX IDX_464BD3E14BE36F9B ON existe (fk_entrepot_id)');
        $this->addSql('ALTER TABLE produits DROP FOREIGN KEY FK_BE2DDF8C391016D9');
        $this->addSql('DROP INDEX IDX_BE2DDF8C391016D9 ON produits');
        $this->addSql('ALTER TABLE produits CHANGE rayon_id_id rayon_id INT NOT NULL');
        $this->addSql('CREATE INDEX IDX_BE2DDF8C391016D9 ON produits (rayon_id)');
        $this->addSql('ALTER TABLE stocker DROP FOREIGN KEY FK_AD495D2B928C01');
        $this->addSql('ALTER TABLE stocker DROP FOREIGN KEY FK_AD495D4F61E5A2');
        $this->addSql('DROP INDEX IDX_AD495D2B928C01 ON stocker');
        $this->addSql('DROP INDEX IDX_AD495D4F61E5A2 ON stocker');
        $this->addSql('ALTER TABLE stocker ADD fk_produit_id INT NOT NULL, ADD fk_magasin_id INT NOT NULL, DROP fk_produit_id_id, DROP fk_magasin_id_id');
        $this->addSql('CREATE INDEX IDX_AD495D2B928C01 ON stocker (fk_produit_id)');
        $this->addSql('CREATE INDEX IDX_AD495D4F61E5A2 ON stocker (fk_magasin_id)');
    }
}
