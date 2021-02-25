<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210225083856 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE hideway ADD country_id INT NOT NULL');
        $this->addSql('ALTER TABLE hideway ADD CONSTRAINT FK_6E05B879F92F3E70 FOREIGN KEY (country_id) REFERENCES country (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_6E05B879F92F3E70 ON hideway (country_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE hideway DROP CONSTRAINT FK_6E05B879F92F3E70');
        $this->addSql('DROP INDEX IDX_6E05B879F92F3E70');
        $this->addSql('ALTER TABLE hideway DROP country_id');
    }
}
