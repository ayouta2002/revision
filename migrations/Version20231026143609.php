<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231026143609 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE boisson ADD marque_id_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE boisson ADD CONSTRAINT FK_8B97C84D30964F9C FOREIGN KEY (marque_id_id) REFERENCES marque (id)');
        $this->addSql('CREATE INDEX IDX_8B97C84D30964F9C ON boisson (marque_id_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE boisson DROP FOREIGN KEY FK_8B97C84D30964F9C');
        $this->addSql('DROP INDEX IDX_8B97C84D30964F9C ON boisson');
        $this->addSql('ALTER TABLE boisson DROP marque_id_id');
    }
}
