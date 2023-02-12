<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230212162505 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE artists_albums (artists_id INT NOT NULL, albums_id INT NOT NULL, INDEX IDX_144789E254A05007 (artists_id), INDEX IDX_144789E2ECBB55AF (albums_id), PRIMARY KEY(artists_id, albums_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE artists_albums ADD CONSTRAINT FK_144789E254A05007 FOREIGN KEY (artists_id) REFERENCES artists (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE artists_albums ADD CONSTRAINT FK_144789E2ECBB55AF FOREIGN KEY (albums_id) REFERENCES albums (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE artists_albums DROP FOREIGN KEY FK_144789E254A05007');
        $this->addSql('ALTER TABLE artists_albums DROP FOREIGN KEY FK_144789E2ECBB55AF');
        $this->addSql('DROP TABLE artists_albums');
    }
}
