<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220331150423 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE property_search (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE departments MODIFY id INT UNSIGNED NOT NULL');
        $this->addSql('ALTER TABLE departments DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE departments CHANGE id id INT UNSIGNED NOT NULL');
        $this->addSql('ALTER TABLE departments ADD PRIMARY KEY (code)');
        $this->addSql('ALTER TABLE gite ADD CONSTRAINT FK_B638C92CA76ED395 FOREIGN KEY (user_id) REFERENCES utilisateur (id)');
        $this->addSql('ALTER TABLE regions MODIFY id INT UNSIGNED NOT NULL');
        $this->addSql('ALTER TABLE regions DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE regions CHANGE id id INT UNSIGNED NOT NULL');
        $this->addSql('ALTER TABLE regions ADD PRIMARY KEY (code)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE property_search');
        $this->addSql('ALTER TABLE departments MODIFY code VARCHAR(3) NOT NULL');
        $this->addSql('ALTER TABLE departments DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE departments CHANGE id id INT UNSIGNED AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE departments ADD PRIMARY KEY (id)');
        $this->addSql('ALTER TABLE gite DROP FOREIGN KEY FK_B638C92CA76ED395');
        $this->addSql('ALTER TABLE regions MODIFY code VARCHAR(3) NOT NULL');
        $this->addSql('ALTER TABLE regions DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE regions CHANGE id id INT UNSIGNED AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE regions ADD PRIMARY KEY (id)');
    }
}
