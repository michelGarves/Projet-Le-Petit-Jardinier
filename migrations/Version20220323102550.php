<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220323102550 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE devis ADD id_client_id INT NOT NULL');
        $this->addSql('ALTER TABLE devis ADD CONSTRAINT FK_8B27C52B99DED506 FOREIGN KEY (id_client_id) REFERENCES client (id)');
        $this->addSql('CREATE INDEX IDX_8B27C52B99DED506 ON devis (id_client_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE devis DROP FOREIGN KEY FK_8B27C52B99DED506');
        $this->addSql('DROP INDEX IDX_8B27C52B99DED506 ON devis');
        $this->addSql('ALTER TABLE devis DROP id_client_id');
    }
}
