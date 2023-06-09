<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230609134332 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE category (id INT AUTO_INCREMENT NOT NULL, story_id INT NOT NULL, name VARCHAR(100) NOT NULL, INDEX IDX_64C19C1AA5D4036 (story_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE chapter (id INT AUTO_INCREMENT NOT NULL, story_id INT NOT NULL, ideas LONGTEXT DEFAULT NULL, name VARCHAR(50) NOT NULL, INDEX IDX_F981B52EAA5D4036 (story_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `character` (id INT AUTO_INCREMENT NOT NULL, category_id INT NOT NULL, story_id INT NOT NULL, firstname VARCHAR(100) DEFAULT NULL, lastname VARCHAR(100) DEFAULT NULL, nickname VARCHAR(100) NOT NULL, age VARCHAR(3) DEFAULT NULL, job VARCHAR(100) DEFAULT NULL, city VARCHAR(100) DEFAULT NULL, ethnic VARCHAR(100) DEFAULT NULL, link VARCHAR(100) DEFAULT NULL, information LONGTEXT DEFAULT NULL, INDEX IDX_937AB03412469DE2 (category_id), INDEX IDX_937AB034AA5D4036 (story_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE story (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, name VARCHAR(100) NOT NULL, INDEX IDX_EB560438A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, firstname VARCHAR(100) NOT NULL, lastname VARCHAR(100) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE category ADD CONSTRAINT FK_64C19C1AA5D4036 FOREIGN KEY (story_id) REFERENCES story (id)');
        $this->addSql('ALTER TABLE chapter ADD CONSTRAINT FK_F981B52EAA5D4036 FOREIGN KEY (story_id) REFERENCES story (id)');
        $this->addSql('ALTER TABLE `character` ADD CONSTRAINT FK_937AB03412469DE2 FOREIGN KEY (category_id) REFERENCES category (id)');
        $this->addSql('ALTER TABLE `character` ADD CONSTRAINT FK_937AB034AA5D4036 FOREIGN KEY (story_id) REFERENCES story (id)');
        $this->addSql('ALTER TABLE story ADD CONSTRAINT FK_EB560438A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE category DROP FOREIGN KEY FK_64C19C1AA5D4036');
        $this->addSql('ALTER TABLE chapter DROP FOREIGN KEY FK_F981B52EAA5D4036');
        $this->addSql('ALTER TABLE `character` DROP FOREIGN KEY FK_937AB03412469DE2');
        $this->addSql('ALTER TABLE `character` DROP FOREIGN KEY FK_937AB034AA5D4036');
        $this->addSql('ALTER TABLE story DROP FOREIGN KEY FK_EB560438A76ED395');
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP TABLE chapter');
        $this->addSql('DROP TABLE `character`');
        $this->addSql('DROP TABLE story');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
