<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210513133922 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE fitxak ADD egoera_id INT NOT NULL');
        $this->addSql('ALTER TABLE fitxak ADD CONSTRAINT FK_E374B4CD969CE4E9 FOREIGN KEY (egoera_id) REFERENCES egoera (id)');
        $this->addSql('CREATE INDEX IDX_E374B4CD969CE4E9 ON fitxak (egoera_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE fitxak DROP FOREIGN KEY FK_E374B4CD969CE4E9');
        $this->addSql('DROP INDEX IDX_E374B4CD969CE4E9 ON fitxak');
        $this->addSql('ALTER TABLE fitxak DROP egoera_id');
    }
}
