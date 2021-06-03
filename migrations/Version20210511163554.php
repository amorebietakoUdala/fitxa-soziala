<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210511163554 extends AbstractMigration
{
    public function getDescription() : string
    {

        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE arrazoia (id INT AUTO_INCREMENT NOT NULL, tree_root INT DEFAULT NULL, parent_id INT DEFAULT NULL, maila_eu VARCHAR(255) NOT NULL, maila_es VARCHAR(255) NOT NULL, lft INT NOT NULL, lvl INT NOT NULL, rgt INT NOT NULL, beste_arrazoia TINYINT(1) DEFAULT NULL, beste_babeseza TINYINT(1) DEFAULT NULL, beste_bazterkeria TINYINT(1) DEFAULT NULL, INDEX IDX_29AF01BCA977936C (tree_root), INDEX IDX_29AF01BC727ACA70 (parent_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE balioespena (id INT AUTO_INCREMENT NOT NULL, tree_root INT DEFAULT NULL, parent_id INT DEFAULT NULL, maila_eu VARCHAR(255) NOT NULL, maila_es VARCHAR(255) NOT NULL, lft INT NOT NULL, lvl INT NOT NULL, rgt INT NOT NULL, beste_balioespena TINYINT(1) DEFAULT NULL, mailan_bakarra TINYINT(1) DEFAULT NULL, INDEX IDX_57B4BE31A977936C (tree_root), INDEX IDX_57B4BE31727ACA70 (parent_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE bizikidetza (id INT AUTO_INCREMENT NOT NULL, bizikidetza_eu VARCHAR(255) NOT NULL, bizikidetza_es VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE bizitokia (id INT AUTO_INCREMENT NOT NULL, bizitokia_eu VARCHAR(255) NOT NULL, bizitokia_es VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE dokumentu_mota (id INT AUTO_INCREMENT NOT NULL, mota VARCHAR(255) NOT NULL, mota_es VARCHAR(255) NOT NULL, mota_eu VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE eragilea (id INT AUTO_INCREMENT NOT NULL, tree_root INT DEFAULT NULL, parent_id INT DEFAULT NULL, eragilea_eu VARCHAR(255) NOT NULL, eragilea_es VARCHAR(255) NOT NULL, lft INT NOT NULL, lvl INT NOT NULL, rgt INT NOT NULL, beste_gaixotasun TINYINT(1) DEFAULT NULL, beste_eragile TINYINT(1) DEFAULT NULL, INDEX IDX_4BB883F7A977936C (tree_root), INDEX IDX_4BB883F7727ACA70 (parent_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE errolda (id INT AUTO_INCREMENT NOT NULL, tree_root INT DEFAULT NULL, parent_id INT DEFAULT NULL, maila_eu VARCHAR(255) NOT NULL, maila_es VARCHAR(255) NOT NULL, lft INT NOT NULL, lvl INT NOT NULL, rgt INT NOT NULL, errolda_data TINYINT(1) DEFAULT NULL, INDEX IDX_98B68925A977936C (tree_root), INDEX IDX_98B68925727ACA70 (parent_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE estatuak (id INT AUTO_INCREMENT NOT NULL, estatua VARCHAR(255) NOT NULL, kodea VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE fitxak (id INT AUTO_INCREMENT NOT NULL, herria_id INT DEFAULT NULL, genero_id INT DEFAULT NULL, estatua_id INT DEFAULT NULL, bizitokia_id INT DEFAULT NULL, bizikidetza_id INT DEFAULT NULL, gaitasuna_id INT DEFAULT NULL, dokumentu_mota_id INT DEFAULT NULL, izena VARCHAR(255) NOT NULL, abizena VARCHAR(255) NOT NULL, dokumentu_zenbakia VARCHAR(255) NOT NULL, jaiotze_data DATE NOT NULL, errolda_data DATE DEFAULT NULL, beste_arrazoia LONGTEXT DEFAULT NULL, beste_balioespena LONGTEXT DEFAULT NULL, beste_gaixotasun LONGTEXT DEFAULT NULL, beste_eragile LONGTEXT DEFAULT NULL, oharrak LONGTEXT DEFAULT NULL, created DATETIME DEFAULT NULL, updated DATETIME DEFAULT NULL, content_changed DATETIME DEFAULT NULL, erabiltzailea VARCHAR(255) NOT NULL, beste_babes_eza LONGTEXT DEFAULT NULL, beste_bazterkeria LONGTEXT DEFAULT NULL, INDEX IDX_E374B4CD2A1C6D7D (herria_id), INDEX IDX_E374B4CDBCE7B795 (genero_id), INDEX IDX_E374B4CDA3AA2C45 (estatua_id), INDEX IDX_E374B4CD3CE17B6C (bizitokia_id), INDEX IDX_E374B4CDBD291D5B (bizikidetza_id), INDEX IDX_E374B4CD904E04FA (gaitasuna_id), INDEX IDX_E374B4CDBBB85101 (dokumentu_mota_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE fitxak_nazionalitatea (fitxak_id INT NOT NULL, nazionalitatea_id INT NOT NULL, INDEX IDX_45D623BB28F71E59 (fitxak_id), INDEX IDX_45D623BBB35E5CF1 (nazionalitatea_id), PRIMARY KEY(fitxak_id, nazionalitatea_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE fitxak_errolda (fitxak_id INT NOT NULL, errolda_id INT NOT NULL, INDEX IDX_26A0A3D528F71E59 (fitxak_id), INDEX IDX_26A0A3D590847418 (errolda_id), PRIMARY KEY(fitxak_id, errolda_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE fitxak_arrazoia (fitxak_id INT NOT NULL, arrazoia_id INT NOT NULL, INDEX IDX_94ACE58A28F71E59 (fitxak_id), INDEX IDX_94ACE58AF5774D55 (arrazoia_id), PRIMARY KEY(fitxak_id, arrazoia_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE fitxak_balioespena (fitxak_id INT NOT NULL, balioespena_id INT NOT NULL, INDEX IDX_D44940FC28F71E59 (fitxak_id), INDEX IDX_D44940FCF5A2BE63 (balioespena_id), PRIMARY KEY(fitxak_id, balioespena_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE fitxak_eragilea (fitxak_id INT NOT NULL, eragilea_id INT NOT NULL, INDEX IDX_F6BB67C128F71E59 (fitxak_id), INDEX IDX_F6BB67C13DE5018 (eragilea_id), PRIMARY KEY(fitxak_id, eragilea_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE gaitasuna (id INT AUTO_INCREMENT NOT NULL, gaitasuna_eu VARCHAR(255) NOT NULL, gaitasuna_es VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE genero (id INT AUTO_INCREMENT NOT NULL, genero_eu VARCHAR(50) NOT NULL, genero_es VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE herria (id INT AUTO_INCREMENT NOT NULL, herria VARCHAR(255) NOT NULL, kodea VARCHAR(6) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE jarduerak (id INT AUTO_INCREMENT NOT NULL, tree_root INT DEFAULT NULL, parent_id INT DEFAULT NULL, maila_eu VARCHAR(255) NOT NULL, maila_es VARCHAR(255) NOT NULL, lft INT NOT NULL, lvl INT NOT NULL, rgt INT NOT NULL, INDEX IDX_17AE0579A977936C (tree_root), INDEX IDX_17AE0579727ACA70 (parent_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE nazionalitatea (id INT AUTO_INCREMENT NOT NULL, tree_root INT DEFAULT NULL, parent_id INT DEFAULT NULL, maila_eu VARCHAR(255) NOT NULL, maila_es VARCHAR(255) NOT NULL, lft INT NOT NULL, lvl INT NOT NULL, rgt INT NOT NULL, estatua TINYINT(1) DEFAULT NULL, INDEX IDX_959264B9A977936C (tree_root), INDEX IDX_959264B9727ACA70 (parent_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, first_name VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, activated TINYINT(1) DEFAULT \'1\', last_login DATETIME DEFAULT NULL, UNIQUE INDEX UNIQ_8D93D649F85E0677 (username), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE arrazoia ADD CONSTRAINT FK_29AF01BCA977936C FOREIGN KEY (tree_root) REFERENCES arrazoia (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE arrazoia ADD CONSTRAINT FK_29AF01BC727ACA70 FOREIGN KEY (parent_id) REFERENCES arrazoia (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE balioespena ADD CONSTRAINT FK_57B4BE31A977936C FOREIGN KEY (tree_root) REFERENCES balioespena (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE balioespena ADD CONSTRAINT FK_57B4BE31727ACA70 FOREIGN KEY (parent_id) REFERENCES balioespena (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE eragilea ADD CONSTRAINT FK_4BB883F7A977936C FOREIGN KEY (tree_root) REFERENCES eragilea (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE eragilea ADD CONSTRAINT FK_4BB883F7727ACA70 FOREIGN KEY (parent_id) REFERENCES eragilea (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE errolda ADD CONSTRAINT FK_98B68925A977936C FOREIGN KEY (tree_root) REFERENCES errolda (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE errolda ADD CONSTRAINT FK_98B68925727ACA70 FOREIGN KEY (parent_id) REFERENCES errolda (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE fitxak ADD CONSTRAINT FK_E374B4CD2A1C6D7D FOREIGN KEY (herria_id) REFERENCES herria (id)');
        $this->addSql('ALTER TABLE fitxak ADD CONSTRAINT FK_E374B4CDBCE7B795 FOREIGN KEY (genero_id) REFERENCES genero (id)');
        $this->addSql('ALTER TABLE fitxak ADD CONSTRAINT FK_E374B4CDA3AA2C45 FOREIGN KEY (estatua_id) REFERENCES estatuak (id)');
        $this->addSql('ALTER TABLE fitxak ADD CONSTRAINT FK_E374B4CD3CE17B6C FOREIGN KEY (bizitokia_id) REFERENCES bizitokia (id)');
        $this->addSql('ALTER TABLE fitxak ADD CONSTRAINT FK_E374B4CDBD291D5B FOREIGN KEY (bizikidetza_id) REFERENCES bizikidetza (id)');
        $this->addSql('ALTER TABLE fitxak ADD CONSTRAINT FK_E374B4CD904E04FA FOREIGN KEY (gaitasuna_id) REFERENCES gaitasuna (id)');
        $this->addSql('ALTER TABLE fitxak ADD CONSTRAINT FK_E374B4CDBBB85101 FOREIGN KEY (dokumentu_mota_id) REFERENCES dokumentu_mota (id)');
        $this->addSql('ALTER TABLE fitxak_nazionalitatea ADD CONSTRAINT FK_45D623BB28F71E59 FOREIGN KEY (fitxak_id) REFERENCES fitxak (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE fitxak_nazionalitatea ADD CONSTRAINT FK_45D623BBB35E5CF1 FOREIGN KEY (nazionalitatea_id) REFERENCES nazionalitatea (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE fitxak_errolda ADD CONSTRAINT FK_26A0A3D528F71E59 FOREIGN KEY (fitxak_id) REFERENCES fitxak (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE fitxak_errolda ADD CONSTRAINT FK_26A0A3D590847418 FOREIGN KEY (errolda_id) REFERENCES errolda (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE fitxak_arrazoia ADD CONSTRAINT FK_94ACE58A28F71E59 FOREIGN KEY (fitxak_id) REFERENCES fitxak (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE fitxak_arrazoia ADD CONSTRAINT FK_94ACE58AF5774D55 FOREIGN KEY (arrazoia_id) REFERENCES arrazoia (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE fitxak_balioespena ADD CONSTRAINT FK_D44940FC28F71E59 FOREIGN KEY (fitxak_id) REFERENCES fitxak (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE fitxak_balioespena ADD CONSTRAINT FK_D44940FCF5A2BE63 FOREIGN KEY (balioespena_id) REFERENCES balioespena (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE fitxak_eragilea ADD CONSTRAINT FK_F6BB67C128F71E59 FOREIGN KEY (fitxak_id) REFERENCES fitxak (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE fitxak_eragilea ADD CONSTRAINT FK_F6BB67C13DE5018 FOREIGN KEY (eragilea_id) REFERENCES eragilea (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE jarduerak ADD CONSTRAINT FK_17AE0579A977936C FOREIGN KEY (tree_root) REFERENCES jarduerak (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE jarduerak ADD CONSTRAINT FK_17AE0579727ACA70 FOREIGN KEY (parent_id) REFERENCES jarduerak (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE nazionalitatea ADD CONSTRAINT FK_959264B9A977936C FOREIGN KEY (tree_root) REFERENCES nazionalitatea (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE nazionalitatea ADD CONSTRAINT FK_959264B9727ACA70 FOREIGN KEY (parent_id) REFERENCES nazionalitatea (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE arrazoia DROP FOREIGN KEY FK_29AF01BCA977936C');
        $this->addSql('ALTER TABLE arrazoia DROP FOREIGN KEY FK_29AF01BC727ACA70');
        $this->addSql('ALTER TABLE fitxak_arrazoia DROP FOREIGN KEY FK_94ACE58AF5774D55');
        $this->addSql('ALTER TABLE balioespena DROP FOREIGN KEY FK_57B4BE31A977936C');
        $this->addSql('ALTER TABLE balioespena DROP FOREIGN KEY FK_57B4BE31727ACA70');
        $this->addSql('ALTER TABLE fitxak_balioespena DROP FOREIGN KEY FK_D44940FCF5A2BE63');
        $this->addSql('ALTER TABLE fitxak DROP FOREIGN KEY FK_E374B4CDBD291D5B');
        $this->addSql('ALTER TABLE fitxak DROP FOREIGN KEY FK_E374B4CD3CE17B6C');
        $this->addSql('ALTER TABLE fitxak DROP FOREIGN KEY FK_E374B4CDBBB85101');
        $this->addSql('ALTER TABLE eragilea DROP FOREIGN KEY FK_4BB883F7A977936C');
        $this->addSql('ALTER TABLE eragilea DROP FOREIGN KEY FK_4BB883F7727ACA70');
        $this->addSql('ALTER TABLE fitxak_eragilea DROP FOREIGN KEY FK_F6BB67C13DE5018');
        $this->addSql('ALTER TABLE errolda DROP FOREIGN KEY FK_98B68925A977936C');
        $this->addSql('ALTER TABLE errolda DROP FOREIGN KEY FK_98B68925727ACA70');
        $this->addSql('ALTER TABLE fitxak_errolda DROP FOREIGN KEY FK_26A0A3D590847418');
        $this->addSql('ALTER TABLE fitxak DROP FOREIGN KEY FK_E374B4CDA3AA2C45');
        $this->addSql('ALTER TABLE fitxak_nazionalitatea DROP FOREIGN KEY FK_45D623BB28F71E59');
        $this->addSql('ALTER TABLE fitxak_errolda DROP FOREIGN KEY FK_26A0A3D528F71E59');
        $this->addSql('ALTER TABLE fitxak_arrazoia DROP FOREIGN KEY FK_94ACE58A28F71E59');
        $this->addSql('ALTER TABLE fitxak_balioespena DROP FOREIGN KEY FK_D44940FC28F71E59');
        $this->addSql('ALTER TABLE fitxak_eragilea DROP FOREIGN KEY FK_F6BB67C128F71E59');
        $this->addSql('ALTER TABLE fitxak DROP FOREIGN KEY FK_E374B4CD904E04FA');
        $this->addSql('ALTER TABLE fitxak DROP FOREIGN KEY FK_E374B4CDBCE7B795');
        $this->addSql('ALTER TABLE fitxak DROP FOREIGN KEY FK_E374B4CD2A1C6D7D');
        $this->addSql('ALTER TABLE jarduerak DROP FOREIGN KEY FK_17AE0579A977936C');
        $this->addSql('ALTER TABLE jarduerak DROP FOREIGN KEY FK_17AE0579727ACA70');
        $this->addSql('ALTER TABLE fitxak_nazionalitatea DROP FOREIGN KEY FK_45D623BBB35E5CF1');
        $this->addSql('ALTER TABLE nazionalitatea DROP FOREIGN KEY FK_959264B9A977936C');
        $this->addSql('ALTER TABLE nazionalitatea DROP FOREIGN KEY FK_959264B9727ACA70');
        $this->addSql('DROP TABLE arrazoia');
        $this->addSql('DROP TABLE balioespena');
        $this->addSql('DROP TABLE bizikidetza');
        $this->addSql('DROP TABLE bizitokia');
        $this->addSql('DROP TABLE dokumentu_mota');
        $this->addSql('DROP TABLE eragilea');
        $this->addSql('DROP TABLE errolda');
        $this->addSql('DROP TABLE estatuak');
        $this->addSql('DROP TABLE fitxak');
        $this->addSql('DROP TABLE fitxak_nazionalitatea');
        $this->addSql('DROP TABLE fitxak_errolda');
        $this->addSql('DROP TABLE fitxak_arrazoia');
        $this->addSql('DROP TABLE fitxak_balioespena');
        $this->addSql('DROP TABLE fitxak_eragilea');
        $this->addSql('DROP TABLE gaitasuna');
        $this->addSql('DROP TABLE genero');
        $this->addSql('DROP TABLE herria');
        $this->addSql('DROP TABLE jarduerak');
        $this->addSql('DROP TABLE nazionalitatea');
        $this->addSql('DROP TABLE user');
    }
}
