<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210224192930 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE administrator_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE agent_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE contact_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE country_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE hideway_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE mission_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE mission_status_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE mission_type_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE nationality_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE speciality_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE target_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE administrator (id INT NOT NULL, name VARCHAR(255) NOT NULL, first_name VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_58DF0651E7927C74 ON administrator (email)');
        $this->addSql('CREATE TABLE agent (id INT NOT NULL, name VARCHAR(255) NOT NULL, first_name VARCHAR(255) NOT NULL, birthdate DATE NOT NULL, identification_code VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_268B9C9D9E80DE4C ON agent (identification_code)');
        $this->addSql('CREATE TABLE contact (id INT NOT NULL, name VARCHAR(255) NOT NULL, first_name VARCHAR(255) NOT NULL, birthdate DATE NOT NULL, code_name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_4C62E63868C814C7 ON contact (code_name)');
        $this->addSql('CREATE TABLE country (id INT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE hideway (id INT NOT NULL, address VARCHAR(255) NOT NULL, code VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_6E05B87977153098 ON hideway (code)');
        $this->addSql('CREATE TABLE mission (id INT NOT NULL, title VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, code_name VARCHAR(255) NOT NULL, start_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, end_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_9067F23C68C814C7 ON mission (code_name)');
        $this->addSql('CREATE TABLE mission_status (id INT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE mission_type (id INT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE nationality (id INT NOT NULL, name VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8AC58B70989D9B62 ON nationality (slug)');
        $this->addSql('CREATE TABLE speciality (id INT NOT NULL, name VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_F3D7A08E989D9B62 ON speciality (slug)');
        $this->addSql('CREATE TABLE target (id INT NOT NULL, name VARCHAR(255) NOT NULL, first_name VARCHAR(255) NOT NULL, birthdate DATE NOT NULL, code_name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_466F2FFC68C814C7 ON target (code_name)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE administrator_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE agent_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE contact_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE country_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE hideway_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE mission_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE mission_status_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE mission_type_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE nationality_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE speciality_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE target_id_seq CASCADE');
        $this->addSql('DROP TABLE administrator');
        $this->addSql('DROP TABLE agent');
        $this->addSql('DROP TABLE contact');
        $this->addSql('DROP TABLE country');
        $this->addSql('DROP TABLE hideway');
        $this->addSql('DROP TABLE mission');
        $this->addSql('DROP TABLE mission_status');
        $this->addSql('DROP TABLE mission_type');
        $this->addSql('DROP TABLE nationality');
        $this->addSql('DROP TABLE speciality');
        $this->addSql('DROP TABLE target');
    }
}
