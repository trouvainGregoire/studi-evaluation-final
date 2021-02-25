<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210225083108 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE agent_speciality (agent_id INT NOT NULL, speciality_id INT NOT NULL, PRIMARY KEY(agent_id, speciality_id))');
        $this->addSql('CREATE INDEX IDX_829171813414710B ON agent_speciality (agent_id)');
        $this->addSql('CREATE INDEX IDX_829171813B5A08D7 ON agent_speciality (speciality_id)');
        $this->addSql('ALTER TABLE agent_speciality ADD CONSTRAINT FK_829171813414710B FOREIGN KEY (agent_id) REFERENCES agent (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE agent_speciality ADD CONSTRAINT FK_829171813B5A08D7 FOREIGN KEY (speciality_id) REFERENCES speciality (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP TABLE agent_speciality');
    }
}
