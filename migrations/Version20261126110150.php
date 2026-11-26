<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20261126110150 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE administrateur (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(50) NOT NULL, prenom VARCHAR(50) NOT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE categorie (id INT AUTO_INCREMENT NOT NULL, nom_categorie VARCHAR(50) NOT NULL, administrateur_id INT DEFAULT NULL, INDEX IDX_497DD6347EE5403C (administrateur_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE jeu (id INT AUTO_INCREMENT NOT NULL, description VARCHAR(255) NOT NULL, duree_moyenne INT NOT NULL, age_minimum INT NOT NULL, nombre_joueurs INT NOT NULL, titre VARCHAR(50) NOT NULL, administrateur_id INT DEFAULT NULL, INDEX IDX_82E48DB57EE5403C (administrateur_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE reservation (id INT AUTO_INCREMENT NOT NULL, soiree_jeu_id INT DEFAULT NULL, utilisateur_id INT DEFAULT NULL, INDEX IDX_42C84955ED97334E (soiree_jeu_id), INDEX IDX_42C84955FB88E14F (utilisateur_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE soiree_jeu (id INT AUTO_INCREMENT NOT NULL, jeu_associe VARCHAR(150) NOT NULL, date_soiree DATETIME NOT NULL, nombre_max_participants INT NOT NULL, administrateur_id INT DEFAULT NULL, INDEX IDX_2E5D4F8D7EE5403C (administrateur_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE utilisateur (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(50) NOT NULL, prenom VARCHAR(50) NOT NULL, email VARCHAR(100) NOT NULL, mot_de_passe VARCHAR(50) NOT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0E3BD61CE16BA31DBBF396750 (queue_name, available_at, delivered_at, id), PRIMARY KEY (id))');
        $this->addSql('ALTER TABLE categorie ADD CONSTRAINT FK_497DD6347EE5403C FOREIGN KEY (administrateur_id) REFERENCES administrateur (id)');
        $this->addSql('ALTER TABLE jeu ADD CONSTRAINT FK_82E48DB57EE5403C FOREIGN KEY (administrateur_id) REFERENCES administrateur (id)');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C84955ED97334E FOREIGN KEY (soiree_jeu_id) REFERENCES soiree_jeu (id)');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C84955FB88E14F FOREIGN KEY (utilisateur_id) REFERENCES utilisateur (id)');
        $this->addSql('ALTER TABLE soiree_jeu ADD CONSTRAINT FK_2E5D4F8D7EE5403C FOREIGN KEY (administrateur_id) REFERENCES administrateur (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE categorie DROP FOREIGN KEY FK_497DD6347EE5403C');
        $this->addSql('ALTER TABLE jeu DROP FOREIGN KEY FK_82E48DB57EE5403C');
        $this->addSql('ALTER TABLE reservation DROP FOREIGN KEY FK_42C84955ED97334E');
        $this->addSql('ALTER TABLE reservation DROP FOREIGN KEY FK_42C84955FB88E14F');
        $this->addSql('ALTER TABLE soiree_jeu DROP FOREIGN KEY FK_2E5D4F8D7EE5403C');
        $this->addSql('DROP TABLE administrateur');
        $this->addSql('DROP TABLE categorie');
        $this->addSql('DROP TABLE jeu');
        $this->addSql('DROP TABLE reservation');
        $this->addSql('DROP TABLE soiree_jeu');
        $this->addSql('DROP TABLE utilisateur');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
