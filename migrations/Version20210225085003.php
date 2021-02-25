<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210225085003 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE mission_agent (mission_id INT NOT NULL, agent_id INT NOT NULL, PRIMARY KEY(mission_id, agent_id))');
        $this->addSql('CREATE INDEX IDX_B61DC3A0BE6CAE90 ON mission_agent (mission_id)');
        $this->addSql('CREATE INDEX IDX_B61DC3A03414710B ON mission_agent (agent_id)');
        $this->addSql('CREATE TABLE mission_contact (mission_id INT NOT NULL, contact_id INT NOT NULL, PRIMARY KEY(mission_id, contact_id))');
        $this->addSql('CREATE INDEX IDX_DD5E7275BE6CAE90 ON mission_contact (mission_id)');
        $this->addSql('CREATE INDEX IDX_DD5E7275E7A1254A ON mission_contact (contact_id)');
        $this->addSql('CREATE TABLE mission_hideway (mission_id INT NOT NULL, hideway_id INT NOT NULL, PRIMARY KEY(mission_id, hideway_id))');
        $this->addSql('CREATE INDEX IDX_FF392C34BE6CAE90 ON mission_hideway (mission_id)');
        $this->addSql('CREATE INDEX IDX_FF392C34611746BE ON mission_hideway (hideway_id)');
        $this->addSql('ALTER TABLE mission_agent ADD CONSTRAINT FK_B61DC3A0BE6CAE90 FOREIGN KEY (mission_id) REFERENCES mission (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE mission_agent ADD CONSTRAINT FK_B61DC3A03414710B FOREIGN KEY (agent_id) REFERENCES agent (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE mission_contact ADD CONSTRAINT FK_DD5E7275BE6CAE90 FOREIGN KEY (mission_id) REFERENCES mission (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE mission_contact ADD CONSTRAINT FK_DD5E7275E7A1254A FOREIGN KEY (contact_id) REFERENCES contact (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE mission_hideway ADD CONSTRAINT FK_FF392C34BE6CAE90 FOREIGN KEY (mission_id) REFERENCES mission (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE mission_hideway ADD CONSTRAINT FK_FF392C34611746BE FOREIGN KEY (hideway_id) REFERENCES hideway (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE mission ADD country_id INT NOT NULL');
        $this->addSql('ALTER TABLE mission ADD type_id INT NOT NULL');
        $this->addSql('ALTER TABLE mission ADD status_id INT NOT NULL');
        $this->addSql('ALTER TABLE mission ADD speciality_id INT NOT NULL');
        $this->addSql('ALTER TABLE mission ADD CONSTRAINT FK_9067F23CF92F3E70 FOREIGN KEY (country_id) REFERENCES country (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE mission ADD CONSTRAINT FK_9067F23CC54C8C93 FOREIGN KEY (type_id) REFERENCES mission_type (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE mission ADD CONSTRAINT FK_9067F23C6BF700BD FOREIGN KEY (status_id) REFERENCES mission_status (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE mission ADD CONSTRAINT FK_9067F23C3B5A08D7 FOREIGN KEY (speciality_id) REFERENCES speciality (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_9067F23CF92F3E70 ON mission (country_id)');
        $this->addSql('CREATE INDEX IDX_9067F23CC54C8C93 ON mission (type_id)');
        $this->addSql('CREATE INDEX IDX_9067F23C6BF700BD ON mission (status_id)');
        $this->addSql('CREATE INDEX IDX_9067F23C3B5A08D7 ON mission (speciality_id)');
        $this->addSql('ALTER TABLE target ADD mission_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE target ADD CONSTRAINT FK_466F2FFCBE6CAE90 FOREIGN KEY (mission_id) REFERENCES mission (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_466F2FFCBE6CAE90 ON target (mission_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP TABLE mission_agent');
        $this->addSql('DROP TABLE mission_contact');
        $this->addSql('DROP TABLE mission_hideway');
        $this->addSql('ALTER TABLE mission DROP CONSTRAINT FK_9067F23CF92F3E70');
        $this->addSql('ALTER TABLE mission DROP CONSTRAINT FK_9067F23CC54C8C93');
        $this->addSql('ALTER TABLE mission DROP CONSTRAINT FK_9067F23C6BF700BD');
        $this->addSql('ALTER TABLE mission DROP CONSTRAINT FK_9067F23C3B5A08D7');
        $this->addSql('DROP INDEX IDX_9067F23CF92F3E70');
        $this->addSql('DROP INDEX IDX_9067F23CC54C8C93');
        $this->addSql('DROP INDEX IDX_9067F23C6BF700BD');
        $this->addSql('DROP INDEX IDX_9067F23C3B5A08D7');
        $this->addSql('ALTER TABLE mission DROP country_id');
        $this->addSql('ALTER TABLE mission DROP type_id');
        $this->addSql('ALTER TABLE mission DROP status_id');
        $this->addSql('ALTER TABLE mission DROP speciality_id');
        $this->addSql('ALTER TABLE target DROP CONSTRAINT FK_466F2FFCBE6CAE90');
        $this->addSql('DROP INDEX IDX_466F2FFCBE6CAE90');
        $this->addSql('ALTER TABLE target DROP mission_id');
    }
}
