<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220329142614 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE contact_disponibility CHANGE contact_id contact_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE disponibility CHANGE gite_id gite_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE gite CHANGE contact_id contact_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE option_price CHANGE id_gite id_gite INT DEFAULT NULL, CHANGE id_option id_option INT DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE contact_disponibility CHANGE contact_id contact_id INT NOT NULL');
        $this->addSql('ALTER TABLE disponibility CHANGE gite_id gite_id INT NOT NULL');
        $this->addSql('ALTER TABLE gite CHANGE contact_id contact_id INT NOT NULL');
        $this->addSql('ALTER TABLE option_price CHANGE id_option id_option INT NOT NULL, CHANGE id_gite id_gite INT NOT NULL');
    }
}
