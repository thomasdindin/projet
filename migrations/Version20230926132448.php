<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230926132448 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE categories (id INT AUTO_INCREMENT NOT NULL, catégories VARCHAR(60) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE commandes ADD CONSTRAINT FK_35D4282C23ADE51C FOREIGN KEY (fk_id_etat_id) REFERENCES etat (id)');
        $this->addSql('ALTER TABLE commandes ADD CONSTRAINT FK_35D4282C23AEAE6E FOREIGN KEY (contient_id) REFERENCES contient (id)');
        $this->addSql('ALTER TABLE commandes ADD CONSTRAINT FK_35D4282C899DB076 FOREIGN KEY (fk_id_user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE contient DROP adresse');
        $this->addSql('ALTER TABLE entrepot ADD CONSTRAINT FK_D805175A8FB96863 FOREIGN KEY (stocke_id) REFERENCES stocke (id)');
        $this->addSql('ALTER TABLE produits ADD fk_id_categorie_id INT NOT NULL');
        $this->addSql('ALTER TABLE produits ADD CONSTRAINT FK_BE2DDF8C23AEAE6E FOREIGN KEY (contient_id) REFERENCES contient (id)');
        $this->addSql('ALTER TABLE produits ADD CONSTRAINT FK_BE2DDF8C8FB96863 FOREIGN KEY (stocke_id) REFERENCES stocke (id)');
        $this->addSql('ALTER TABLE produits ADD CONSTRAINT FK_BE2DDF8C4697C66A FOREIGN KEY (fk_id_categorie_id) REFERENCES categories (id)');
        $this->addSql('CREATE INDEX IDX_BE2DDF8C4697C66A ON produits (fk_id_categorie_id)');
        $this->addSql('ALTER TABLE user ADD adresse VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE produits DROP FOREIGN KEY FK_BE2DDF8C4697C66A');
        $this->addSql('DROP TABLE categories');
        $this->addSql('ALTER TABLE commandes DROP FOREIGN KEY FK_35D4282C23ADE51C');
        $this->addSql('ALTER TABLE commandes DROP FOREIGN KEY FK_35D4282C23AEAE6E');
        $this->addSql('ALTER TABLE commandes DROP FOREIGN KEY FK_35D4282C899DB076');
        $this->addSql('ALTER TABLE produits DROP FOREIGN KEY FK_BE2DDF8C23AEAE6E');
        $this->addSql('ALTER TABLE produits DROP FOREIGN KEY FK_BE2DDF8C8FB96863');
        $this->addSql('DROP INDEX IDX_BE2DDF8C4697C66A ON produits');
        $this->addSql('ALTER TABLE produits DROP fk_id_categorie_id');
        $this->addSql('ALTER TABLE contient ADD adresse VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE entrepot DROP FOREIGN KEY FK_D805175A8FB96863');
        $this->addSql('ALTER TABLE user DROP adresse');
    }
}
