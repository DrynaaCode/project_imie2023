<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230212163819 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE users_songs (users_id INT NOT NULL, songs_id INT NOT NULL, INDEX IDX_5D9B15D267B3B43D (users_id), INDEX IDX_5D9B15D2C365A331 (songs_id), PRIMARY KEY(users_id, songs_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE users_songs ADD CONSTRAINT FK_5D9B15D267B3B43D FOREIGN KEY (users_id) REFERENCES users (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE users_songs ADD CONSTRAINT FK_5D9B15D2C365A331 FOREIGN KEY (songs_id) REFERENCES songs (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE users_songs DROP FOREIGN KEY FK_5D9B15D267B3B43D');
        $this->addSql('ALTER TABLE users_songs DROP FOREIGN KEY FK_5D9B15D2C365A331');
        $this->addSql('DROP TABLE users_songs');
    }
}
