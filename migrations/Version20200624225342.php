<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200624225342 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE medic (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, image VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE relative_has_medic (id INT AUTO_INCREMENT NOT NULL, medic_id_id INT NOT NULL, relative_id_id INT NOT NULL, dose INT NOT NULL, nb_times INT NOT NULL, created_at DATETIME NOT NULL, end_at DATETIME DEFAULT NULL, comment VARCHAR(255) DEFAULT NULL, INDEX IDX_8A6A033F7C24BCF (medic_id_id), INDEX IDX_8A6A0338D093533 (relative_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE relative_has_medic ADD CONSTRAINT FK_8A6A033F7C24BCF FOREIGN KEY (medic_id_id) REFERENCES medic (id)');
        $this->addSql('ALTER TABLE relative_has_medic ADD CONSTRAINT FK_8A6A0338D093533 FOREIGN KEY (relative_id_id) REFERENCES relative (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE relative_has_medic DROP FOREIGN KEY FK_8A6A033F7C24BCF');
        $this->addSql('DROP TABLE medic');
        $this->addSql('DROP TABLE relative_has_medic');
    }
}
