<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230212161459 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE albums (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, release_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE artists (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, listeners INT DEFAULT NULL, is_valid TINYINT(1) NOT NULL, description VARCHAR(255) DEFAULT NULL, path_picture VARCHAR(255) NOT NULL, followers INT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE gender (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE genres (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(100) NOT NULL, UNIQUE INDEX UNIQ_A8EBE5165E237E06 (name), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE playlists (id INT AUTO_INCREMENT NOT NULL, users_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, description VARCHAR(255) DEFAULT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', followers INT DEFAULT NULL, created_by INT NOT NULL, INDEX IDX_5E06116F67B3B43D (users_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE playlists_songs (playlists_id INT NOT NULL, songs_id INT NOT NULL, INDEX IDX_D7BF02DC9F70CF56 (playlists_id), INDEX IDX_D7BF02DCC365A331 (songs_id), PRIMARY KEY(playlists_id, songs_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE songs (id INT AUTO_INCREMENT NOT NULL, song_type_id INT NOT NULL, title VARCHAR(255) NOT NULL, listening INT DEFAULT NULL, release_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', duration TIME NOT NULL, path_picture VARCHAR(255) NOT NULL, active TINYINT(1) NOT NULL, INDEX IDX_BAECB19BC8279DBC (song_type_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE users (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, lastname VARCHAR(100) NOT NULL, firstname VARCHAR(100) NOT NULL, address VARCHAR(255) NOT NULL, zipcode VARCHAR(5) NOT NULL, city VARCHAR(150) NOT NULL, created_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', pseudo VARCHAR(100) NOT NULL, country VARCHAR(100) NOT NULL, UNIQUE INDEX UNIQ_1483A5E9E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE playlists ADD CONSTRAINT FK_5E06116F67B3B43D FOREIGN KEY (users_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE playlists_songs ADD CONSTRAINT FK_D7BF02DC9F70CF56 FOREIGN KEY (playlists_id) REFERENCES playlists (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE playlists_songs ADD CONSTRAINT FK_D7BF02DCC365A331 FOREIGN KEY (songs_id) REFERENCES songs (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE songs ADD CONSTRAINT FK_BAECB19BC8279DBC FOREIGN KEY (song_type_id) REFERENCES genres (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE playlists DROP FOREIGN KEY FK_5E06116F67B3B43D');
        $this->addSql('ALTER TABLE playlists_songs DROP FOREIGN KEY FK_D7BF02DC9F70CF56');
        $this->addSql('ALTER TABLE playlists_songs DROP FOREIGN KEY FK_D7BF02DCC365A331');
        $this->addSql('ALTER TABLE songs DROP FOREIGN KEY FK_BAECB19BC8279DBC');
        $this->addSql('DROP TABLE albums');
        $this->addSql('DROP TABLE artists');
        $this->addSql('DROP TABLE gender');
        $this->addSql('DROP TABLE genres');
        $this->addSql('DROP TABLE playlists');
        $this->addSql('DROP TABLE playlists_songs');
        $this->addSql('DROP TABLE songs');
        $this->addSql('DROP TABLE users');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
