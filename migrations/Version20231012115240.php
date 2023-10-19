<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231012115240 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE commande RENAME INDEX idx_6eeaa67d6de8af9c TO IDX_6EEAA67D5741EEB9');
        $this->addSql('ALTER TABLE contenir RENAME INDEX idx_3c914dfd2b928c01 TO IDX_3C914DFDFF5AB468');
        $this->addSql('ALTER TABLE contenir RENAME INDEX idx_3c914dfd3322a87d TO IDX_3C914DFDEB1C8260');
        $this->addSql('ALTER TABLE contenir RENAME INDEX idx_3c914dfd4be36f9b TO IDX_3C914DFD1B75B2A3');
        $this->addSql('ALTER TABLE existe RENAME INDEX idx_464bd3e12b928c01 TO IDX_464BD3E1FF5AB468');
        $this->addSql('ALTER TABLE existe RENAME INDEX idx_464bd3e14be36f9b TO IDX_464BD3E11B75B2A3');
        $this->addSql('ALTER TABLE produits DROP taille');
        $this->addSql('ALTER TABLE produits RENAME INDEX idx_be2ddf8c391016d9 TO IDX_BE2DDF8CD3202E52');
        $this->addSql('ALTER TABLE stocker RENAME INDEX idx_ad495d2b928c01 TO IDX_AD495DFF5AB468');
        $this->addSql('ALTER TABLE stocker RENAME INDEX idx_ad495d4f61e5a2 TO IDX_AD495DD067A070');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE commande RENAME INDEX idx_6eeaa67d5741eeb9 TO IDX_6EEAA67D6DE8AF9C');
        $this->addSql('ALTER TABLE existe RENAME INDEX idx_464bd3e1ff5ab468 TO IDX_464BD3E12B928C01');
        $this->addSql('ALTER TABLE existe RENAME INDEX idx_464bd3e11b75b2a3 TO IDX_464BD3E14BE36F9B');
        $this->addSql('ALTER TABLE stocker RENAME INDEX idx_ad495dff5ab468 TO IDX_AD495D2B928C01');
        $this->addSql('ALTER TABLE stocker RENAME INDEX idx_ad495dd067a070 TO IDX_AD495D4F61E5A2');
        $this->addSql('ALTER TABLE contenir RENAME INDEX idx_3c914dfdff5ab468 TO IDX_3C914DFD2B928C01');
        $this->addSql('ALTER TABLE contenir RENAME INDEX idx_3c914dfdeb1c8260 TO IDX_3C914DFD3322A87D');
        $this->addSql('ALTER TABLE contenir RENAME INDEX idx_3c914dfd1b75b2a3 TO IDX_3C914DFD4BE36F9B');
        $this->addSql('ALTER TABLE produits ADD taille VARCHAR(10) NOT NULL');
        $this->addSql('ALTER TABLE produits RENAME INDEX idx_be2ddf8cd3202e52 TO IDX_BE2DDF8C391016D9');
    }
}
