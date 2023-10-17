<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231012100825 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE commande DROP FOREIGN KEY FK_6EEAA67D6DE8AF9C');
        $this->addSql('DROP INDEX IDX_6EEAA67D6DE8AF9C ON commande');
        $this->addSql('ALTER TABLE commande CHANGE fk_user_id_id fk_user_id INT NOT NULL');
        $this->addSql('ALTER TABLE commande ADD CONSTRAINT FK_6EEAA67D5741EEB9 FOREIGN KEY (fk_user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_6EEAA67D5741EEB9 ON commande (fk_user_id)');
        $this->addSql('ALTER TABLE contenir DROP FOREIGN KEY FK_3C914DFD2B928C01');
        $this->addSql('ALTER TABLE contenir DROP FOREIGN KEY FK_3C914DFD3322A87D');
        $this->addSql('ALTER TABLE contenir DROP FOREIGN KEY FK_3C914DFD4BE36F9B');
        $this->addSql('DROP INDEX IDX_3C914DFD2B928C01 ON contenir');
        $this->addSql('DROP INDEX IDX_3C914DFD3322A87D ON contenir');
        $this->addSql('DROP INDEX IDX_3C914DFD4BE36F9B ON contenir');
        $this->addSql('ALTER TABLE contenir ADD fk_produit_id INT NOT NULL, ADD fk_commande_id INT NOT NULL, ADD fk_entrepot_id INT NOT NULL, DROP fk_produit_id_id, DROP fk_commande_id_id, DROP fk_entrepot_id_id');
        $this->addSql('ALTER TABLE contenir ADD CONSTRAINT FK_3C914DFDFF5AB468 FOREIGN KEY (fk_produit_id) REFERENCES produits (id)');
        $this->addSql('ALTER TABLE contenir ADD CONSTRAINT FK_3C914DFDEB1C8260 FOREIGN KEY (fk_commande_id) REFERENCES commande (id)');
        $this->addSql('ALTER TABLE contenir ADD CONSTRAINT FK_3C914DFD1B75B2A3 FOREIGN KEY (fk_entrepot_id) REFERENCES entrepot (id)');
        $this->addSql('CREATE INDEX IDX_3C914DFDFF5AB468 ON contenir (fk_produit_id)');
        $this->addSql('CREATE INDEX IDX_3C914DFDEB1C8260 ON contenir (fk_commande_id)');
        $this->addSql('CREATE INDEX IDX_3C914DFD1B75B2A3 ON contenir (fk_entrepot_id)');
        $this->addSql('ALTER TABLE existe DROP FOREIGN KEY FK_464BD3E12B928C01');
        $this->addSql('ALTER TABLE existe DROP FOREIGN KEY FK_464BD3E14BE36F9B');
        $this->addSql('DROP INDEX IDX_464BD3E12B928C01 ON existe');
        $this->addSql('DROP INDEX IDX_464BD3E14BE36F9B ON existe');
        $this->addSql('ALTER TABLE existe ADD fk_produit_id INT NOT NULL, ADD fk_entrepot_id INT NOT NULL, DROP fk_produit_id_id, DROP fk_entrepot_id_id');
        $this->addSql('ALTER TABLE existe ADD CONSTRAINT FK_464BD3E1FF5AB468 FOREIGN KEY (fk_produit_id) REFERENCES produits (id)');
        $this->addSql('ALTER TABLE existe ADD CONSTRAINT FK_464BD3E11B75B2A3 FOREIGN KEY (fk_entrepot_id) REFERENCES entrepot (id)');
        $this->addSql('CREATE INDEX IDX_464BD3E1FF5AB468 ON existe (fk_produit_id)');
        $this->addSql('CREATE INDEX IDX_464BD3E11B75B2A3 ON existe (fk_entrepot_id)');
        $this->addSql('ALTER TABLE produits DROP FOREIGN KEY FK_BE2DDF8C391016D9');
        $this->addSql('DROP INDEX IDX_BE2DDF8C391016D9 ON produits');
        $this->addSql('ALTER TABLE produits CHANGE rayon_id_id rayon_id INT NOT NULL');
        $this->addSql('ALTER TABLE produits ADD CONSTRAINT FK_BE2DDF8CD3202E52 FOREIGN KEY (rayon_id) REFERENCES rayon (id)');
        $this->addSql('CREATE INDEX IDX_BE2DDF8CD3202E52 ON produits (rayon_id)');
        $this->addSql('ALTER TABLE stocker DROP FOREIGN KEY FK_AD495D2B928C01');
        $this->addSql('ALTER TABLE stocker DROP FOREIGN KEY FK_AD495D4F61E5A2');
        $this->addSql('DROP INDEX IDX_AD495D2B928C01 ON stocker');
        $this->addSql('DROP INDEX IDX_AD495D4F61E5A2 ON stocker');
        $this->addSql('ALTER TABLE stocker ADD fk_produit_id INT NOT NULL, ADD fk_magasin_id INT NOT NULL, DROP fk_produit_id_id, DROP fk_magasin_id_id');
        $this->addSql('ALTER TABLE stocker ADD CONSTRAINT FK_AD495DFF5AB468 FOREIGN KEY (fk_produit_id) REFERENCES produits (id)');
        $this->addSql('ALTER TABLE stocker ADD CONSTRAINT FK_AD495DD067A070 FOREIGN KEY (fk_magasin_id) REFERENCES magasin (id)');
        $this->addSql('CREATE INDEX IDX_AD495DFF5AB468 ON stocker (fk_produit_id)');
        $this->addSql('CREATE INDEX IDX_AD495DD067A070 ON stocker (fk_magasin_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE commande DROP FOREIGN KEY FK_6EEAA67D5741EEB9');
        $this->addSql('DROP INDEX IDX_6EEAA67D5741EEB9 ON commande');
        $this->addSql('ALTER TABLE commande CHANGE fk_user_id fk_user_id_id INT NOT NULL');
        $this->addSql('ALTER TABLE commande ADD CONSTRAINT FK_6EEAA67D6DE8AF9C FOREIGN KEY (fk_user_id_id) REFERENCES user (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_6EEAA67D6DE8AF9C ON commande (fk_user_id_id)');
        $this->addSql('ALTER TABLE existe DROP FOREIGN KEY FK_464BD3E1FF5AB468');
        $this->addSql('ALTER TABLE existe DROP FOREIGN KEY FK_464BD3E11B75B2A3');
        $this->addSql('DROP INDEX IDX_464BD3E1FF5AB468 ON existe');
        $this->addSql('DROP INDEX IDX_464BD3E11B75B2A3 ON existe');
        $this->addSql('ALTER TABLE existe ADD fk_produit_id_id INT NOT NULL, ADD fk_entrepot_id_id INT NOT NULL, DROP fk_produit_id, DROP fk_entrepot_id');
        $this->addSql('ALTER TABLE existe ADD CONSTRAINT FK_464BD3E12B928C01 FOREIGN KEY (fk_produit_id_id) REFERENCES produits (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE existe ADD CONSTRAINT FK_464BD3E14BE36F9B FOREIGN KEY (fk_entrepot_id_id) REFERENCES entrepot (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_464BD3E12B928C01 ON existe (fk_produit_id_id)');
        $this->addSql('CREATE INDEX IDX_464BD3E14BE36F9B ON existe (fk_entrepot_id_id)');
        $this->addSql('ALTER TABLE stocker DROP FOREIGN KEY FK_AD495DFF5AB468');
        $this->addSql('ALTER TABLE stocker DROP FOREIGN KEY FK_AD495DD067A070');
        $this->addSql('DROP INDEX IDX_AD495DFF5AB468 ON stocker');
        $this->addSql('DROP INDEX IDX_AD495DD067A070 ON stocker');
        $this->addSql('ALTER TABLE stocker ADD fk_produit_id_id INT NOT NULL, ADD fk_magasin_id_id INT NOT NULL, DROP fk_produit_id, DROP fk_magasin_id');
        $this->addSql('ALTER TABLE stocker ADD CONSTRAINT FK_AD495D2B928C01 FOREIGN KEY (fk_produit_id_id) REFERENCES produits (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE stocker ADD CONSTRAINT FK_AD495D4F61E5A2 FOREIGN KEY (fk_magasin_id_id) REFERENCES magasin (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_AD495D2B928C01 ON stocker (fk_produit_id_id)');
        $this->addSql('CREATE INDEX IDX_AD495D4F61E5A2 ON stocker (fk_magasin_id_id)');
        $this->addSql('ALTER TABLE contenir DROP FOREIGN KEY FK_3C914DFDFF5AB468');
        $this->addSql('ALTER TABLE contenir DROP FOREIGN KEY FK_3C914DFDEB1C8260');
        $this->addSql('ALTER TABLE contenir DROP FOREIGN KEY FK_3C914DFD1B75B2A3');
        $this->addSql('DROP INDEX IDX_3C914DFDFF5AB468 ON contenir');
        $this->addSql('DROP INDEX IDX_3C914DFDEB1C8260 ON contenir');
        $this->addSql('DROP INDEX IDX_3C914DFD1B75B2A3 ON contenir');
        $this->addSql('ALTER TABLE contenir ADD fk_produit_id_id INT NOT NULL, ADD fk_commande_id_id INT NOT NULL, ADD fk_entrepot_id_id INT NOT NULL, DROP fk_produit_id, DROP fk_commande_id, DROP fk_entrepot_id');
        $this->addSql('ALTER TABLE contenir ADD CONSTRAINT FK_3C914DFD2B928C01 FOREIGN KEY (fk_produit_id_id) REFERENCES produits (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE contenir ADD CONSTRAINT FK_3C914DFD3322A87D FOREIGN KEY (fk_commande_id_id) REFERENCES commande (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE contenir ADD CONSTRAINT FK_3C914DFD4BE36F9B FOREIGN KEY (fk_entrepot_id_id) REFERENCES entrepot (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_3C914DFD2B928C01 ON contenir (fk_produit_id_id)');
        $this->addSql('CREATE INDEX IDX_3C914DFD3322A87D ON contenir (fk_commande_id_id)');
        $this->addSql('CREATE INDEX IDX_3C914DFD4BE36F9B ON contenir (fk_entrepot_id_id)');
        $this->addSql('ALTER TABLE produits DROP FOREIGN KEY FK_BE2DDF8CD3202E52');
        $this->addSql('DROP INDEX IDX_BE2DDF8CD3202E52 ON produits');
        $this->addSql('ALTER TABLE produits CHANGE rayon_id rayon_id_id INT NOT NULL');
        $this->addSql('ALTER TABLE produits ADD CONSTRAINT FK_BE2DDF8C391016D9 FOREIGN KEY (rayon_id_id) REFERENCES rayon (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_BE2DDF8C391016D9 ON produits (rayon_id_id)');
    }
}
