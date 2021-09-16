<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210916144925 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE jeux (id INT AUTO_INCREMENT NOT NULL, titre VARCHAR(255) NOT NULL, editeur VARCHAR(255) NOT NULL, date DATE NOT NULL, type VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, img_cover VARCHAR(255) NOT NULL, img_gameplay LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tournois (id INT AUTO_INCREMENT NOT NULL, jeu_id INT NOT NULL, titre VARCHAR(255) NOT NULL, date_debut DATE NOT NULL, description LONGTEXT NOT NULL, max_player INT NOT NULL, user LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\', prix NUMERIC(10, 2) NOT NULL, INDEX IDX_D7AAF978C9E392E (jeu_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE tournois ADD CONSTRAINT FK_D7AAF978C9E392E FOREIGN KEY (jeu_id) REFERENCES jeux (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE tournois DROP FOREIGN KEY FK_D7AAF978C9E392E');
        $this->addSql('DROP TABLE jeux');
        $this->addSql('DROP TABLE tournois');
    }
}
