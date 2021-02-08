<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210208150744 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE category (id INT AUTO_INCREMENT NOT NULL, cat_parent_id INT DEFAULT NULL, cat_name VARCHAR(50) NOT NULL, INDEX IDX_64C19C19D2DF21F (cat_parent_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE comment_post (id INT AUTO_INCREMENT NOT NULL, post_id BIGINT NOT NULL, user_id BIGINT NOT NULL, com_post_date DATETIME NOT NULL, com_update_date DATETIME DEFAULT NULL, com_post_content LONGTEXT NOT NULL, INDEX IDX_7CBCCE614B89032C (post_id), INDEX IDX_7CBCCE61A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE comment_reservation (id INT AUTO_INCREMENT NOT NULL, reservation_id BIGINT NOT NULL, com_res_date DATETIME NOT NULL, com_res_content LONGTEXT NOT NULL, UNIQUE INDEX UNIQ_79248817B83297E7 (reservation_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE country (id VARCHAR(2) NOT NULL, cou_name VARCHAR(45) NOT NULL, cou_english_name VARCHAR(45) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE equipment (id INT AUTO_INCREMENT NOT NULL, equ_name VARCHAR(50) NOT NULL, equ_description LONGTEXT DEFAULT NULL, equ_english_name VARCHAR(50) NOT NULL, equ_english_description LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE equipment_room (equipment_id INT NOT NULL, room_id INT NOT NULL, INDEX IDX_481B809D517FE9FE (equipment_id), INDEX IDX_481B809D54177093 (room_id), PRIMARY KEY(equipment_id, room_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE gite (id INT AUTO_INCREMENT NOT NULL, git_name VARCHAR(25) NOT NULL, git_description LONGTEXT NOT NULL, git_address VARCHAR(100) NOT NULL, git_city VARCHAR(50) NOT NULL, git_zipcode VARCHAR(5) NOT NULL, git_phone VARCHAR(10) NOT NULL, git_mail VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE post (id BIGINT AUTO_INCREMENT NOT NULL, category_id INT NOT NULL, post_content LONGTEXT NOT NULL, post_title LONGTEXT NOT NULL, post_status VARCHAR(20) NOT NULL, post_comment_status VARCHAR(20) NOT NULL, post_name VARCHAR(200) NOT NULL, post_comment_count BIGINT NOT NULL, post_update_date DATETIME DEFAULT NULL, INDEX IDX_5A8A6C8D12469DE2 (category_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reservation (id BIGINT AUTO_INCREMENT NOT NULL, users_id BIGINT NOT NULL, season_id INT DEFAULT NULL, res_date DATETIME NOT NULL, res_date_start DATE NOT NULL, res_date_end DATE NOT NULL, res_price INT NOT NULL, res_payment_date DATETIME DEFAULT NULL, INDEX IDX_42C8495567B3B43D (users_id), INDEX IDX_42C849554EC001D1 (season_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE room (id INT AUTO_INCREMENT NOT NULL, gite_id INT NOT NULL, roo_name VARCHAR(50) NOT NULL, roo_picture VARCHAR(100) DEFAULT NULL, INDEX IDX_729F519B652CAE9B (gite_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE rule (id INT AUTO_INCREMENT NOT NULL, gite_id INT NOT NULL, rul_title VARCHAR(50) NOT NULL, rul_description LONGTEXT NOT NULL, rul_english_title VARCHAR(50) NOT NULL, rul_english_description LONGTEXT NOT NULL, INDEX IDX_46D8ACCC652CAE9B (gite_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE season (id INT AUTO_INCREMENT NOT NULL, sea_price INT NOT NULL, sea_date_start DATE NOT NULL, sea_date_end DATE NOT NULL, sea_name VARCHAR(25) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE users (id BIGINT AUTO_INCREMENT NOT NULL, country_id VARCHAR(2) NOT NULL, use_last_name VARCHAR(50) NOT NULL, use_first_name VARCHAR(50) NOT NULL, use_mail VARCHAR(255) NOT NULL, use_phone VARCHAR(10) NOT NULL, use_password VARCHAR(60) NOT NULL, use_add_date DATETIME NOT NULL, use_update_date DATETIME DEFAULT NULL, use_url VARCHAR(200) NOT NULL, use_ip VARCHAR(100) NOT NULL, INDEX IDX_1483A5E9F92F3E70 (country_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE category ADD CONSTRAINT FK_64C19C19D2DF21F FOREIGN KEY (cat_parent_id) REFERENCES category (id)');
        $this->addSql('ALTER TABLE comment_post ADD CONSTRAINT FK_7CBCCE614B89032C FOREIGN KEY (post_id) REFERENCES post (id)');
        $this->addSql('ALTER TABLE comment_post ADD CONSTRAINT FK_7CBCCE61A76ED395 FOREIGN KEY (user_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE comment_reservation ADD CONSTRAINT FK_79248817B83297E7 FOREIGN KEY (reservation_id) REFERENCES reservation (id)');
        $this->addSql('ALTER TABLE equipment_room ADD CONSTRAINT FK_481B809D517FE9FE FOREIGN KEY (equipment_id) REFERENCES equipment (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE equipment_room ADD CONSTRAINT FK_481B809D54177093 FOREIGN KEY (room_id) REFERENCES room (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE post ADD CONSTRAINT FK_5A8A6C8D12469DE2 FOREIGN KEY (category_id) REFERENCES category (id)');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C8495567B3B43D FOREIGN KEY (users_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C849554EC001D1 FOREIGN KEY (season_id) REFERENCES season (id)');
        $this->addSql('ALTER TABLE room ADD CONSTRAINT FK_729F519B652CAE9B FOREIGN KEY (gite_id) REFERENCES gite (id)');
        $this->addSql('ALTER TABLE rule ADD CONSTRAINT FK_46D8ACCC652CAE9B FOREIGN KEY (gite_id) REFERENCES gite (id)');
        $this->addSql('ALTER TABLE users ADD CONSTRAINT FK_1483A5E9F92F3E70 FOREIGN KEY (country_id) REFERENCES country (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE category DROP FOREIGN KEY FK_64C19C19D2DF21F');
        $this->addSql('ALTER TABLE post DROP FOREIGN KEY FK_5A8A6C8D12469DE2');
        $this->addSql('ALTER TABLE users DROP FOREIGN KEY FK_1483A5E9F92F3E70');
        $this->addSql('ALTER TABLE equipment_room DROP FOREIGN KEY FK_481B809D517FE9FE');
        $this->addSql('ALTER TABLE room DROP FOREIGN KEY FK_729F519B652CAE9B');
        $this->addSql('ALTER TABLE rule DROP FOREIGN KEY FK_46D8ACCC652CAE9B');
        $this->addSql('ALTER TABLE comment_post DROP FOREIGN KEY FK_7CBCCE614B89032C');
        $this->addSql('ALTER TABLE comment_reservation DROP FOREIGN KEY FK_79248817B83297E7');
        $this->addSql('ALTER TABLE equipment_room DROP FOREIGN KEY FK_481B809D54177093');
        $this->addSql('ALTER TABLE reservation DROP FOREIGN KEY FK_42C849554EC001D1');
        $this->addSql('ALTER TABLE comment_post DROP FOREIGN KEY FK_7CBCCE61A76ED395');
        $this->addSql('ALTER TABLE reservation DROP FOREIGN KEY FK_42C8495567B3B43D');
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP TABLE comment_post');
        $this->addSql('DROP TABLE comment_reservation');
        $this->addSql('DROP TABLE country');
        $this->addSql('DROP TABLE equipment');
        $this->addSql('DROP TABLE equipment_room');
        $this->addSql('DROP TABLE gite');
        $this->addSql('DROP TABLE post');
        $this->addSql('DROP TABLE reservation');
        $this->addSql('DROP TABLE room');
        $this->addSql('DROP TABLE rule');
        $this->addSql('DROP TABLE season');
        $this->addSql('DROP TABLE users');
    }
}
