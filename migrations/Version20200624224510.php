<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200624224510 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE relative (id INT AUTO_INCREMENT NOT NULL, user_id_id INT DEFAULT NULL, first_name VARCHAR(255) NOT NULL, last_name VARCHAR(255) NOT NULL, birthdate DATETIME NOT NULL, gender VARCHAR(50) NOT NULL, is_user TINYINT(1) NOT NULL, relationship VARCHAR(100) NOT NULL, INDEX IDX_6E5B37D99D86650F (user_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE relative ADD CONSTRAINT FK_6E5B37D99D86650F FOREIGN KEY (user_id_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE user ADD reset_token VARCHAR(255) DEFAULT NULL, ADD zip_code VARCHAR(6) DEFAULT NULL, ADD is_verified TINYINT(1) NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE relative');
        $this->addSql('ALTER TABLE user DROP reset_token, DROP zip_code, DROP is_verified');
    }
}
