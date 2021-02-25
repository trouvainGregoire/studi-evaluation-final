<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210225104125 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE country ADD nationality_id INT NOT NULL');
        $this->addSql('ALTER TABLE country ADD CONSTRAINT FK_5373C9661C9DA55 FOREIGN KEY (nationality_id) REFERENCES nationality (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_5373C9661C9DA55 ON country (nationality_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE country DROP CONSTRAINT FK_5373C9661C9DA55');
        $this->addSql('DROP INDEX UNIQ_5373C9661C9DA55');
        $this->addSql('ALTER TABLE country DROP nationality_id');
    }
}
