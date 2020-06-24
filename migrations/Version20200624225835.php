<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200624225835 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE treatment_hour (id INT AUTO_INCREMENT NOT NULL, has_medic_id_id INT NOT NULL, hour VARCHAR(255) NOT NULL, INDEX IDX_B3DDDD5F9E22CBC8 (has_medic_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE treatment_hour ADD CONSTRAINT FK_B3DDDD5F9E22CBC8 FOREIGN KEY (has_medic_id_id) REFERENCES relative_has_medic (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE treatment_hour');
    }
}
