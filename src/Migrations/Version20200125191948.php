<?php

declare(strict_types=1);

namespace Application\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200125191948 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE Country (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(80) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');

        $this->addSql('CREATE TABLE State (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(80) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');

        $this->addSql('ALTER TABLE State ADD country_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE State ADD CONSTRAINT FK_6252FDFFF92F3E70 FOREIGN KEY (country_id) REFERENCES Country (id)');
        $this->addSql('CREATE INDEX IDX_6252FDFFF92F3E70 ON State (country_id)');

        $this->addSql('CREATE TABLE County (id INT AUTO_INCREMENT NOT NULL, state_id INT DEFAULT NULL, name VARCHAR(80) NOT NULL, INDEX IDX_5F4EFA135D83CC1 (state_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE County ADD CONSTRAINT FK_5F4EFA135D83CC1 FOREIGN KEY (state_id) REFERENCES State (id)');

        $this->addSql('ALTER TABLE County ADD tax_rate NUMERIC(5, 2) NOT NULL');

        $this->addSql('CREATE TABLE Income (id INT AUTO_INCREMENT NOT NULL, county_id INT DEFAULT NULL, amount NUMERIC(11, 2) NOT NULL, INDEX IDX_380467E685E73F45 (county_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE Income ADD CONSTRAINT FK_380467E685E73F45 FOREIGN KEY (county_id) REFERENCES County (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE Country');

        $this->addSql('DROP TABLE State');

        $this->addSql('ALTER TABLE State DROP FOREIGN KEY FK_6252FDFFF92F3E70');
        $this->addSql('DROP INDEX IDX_6252FDFFF92F3E70 ON State');
        $this->addSql('ALTER TABLE State DROP country_id');

        $this->addSql('DROP TABLE County');

        $this->addSql('ALTER TABLE County DROP tax_rate');

        $this->addSql('DROP TABLE Income');
    }
}
