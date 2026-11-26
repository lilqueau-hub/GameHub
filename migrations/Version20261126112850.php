<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20261126112850 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE jeu_categorie (jeu_id INT NOT NULL, categorie_id INT NOT NULL, INDEX IDX_E337000C8C9E392E (jeu_id), INDEX IDX_E337000CBCF5E72D (categorie_id), PRIMARY KEY (jeu_id, categorie_id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('ALTER TABLE jeu_categorie ADD CONSTRAINT FK_E337000C8C9E392E FOREIGN KEY (jeu_id) REFERENCES jeu (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE jeu_categorie ADD CONSTRAINT FK_E337000CBCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE jeu_categorie DROP FOREIGN KEY FK_E337000C8C9E392E');
        $this->addSql('ALTER TABLE jeu_categorie DROP FOREIGN KEY FK_E337000CBCF5E72D');
        $this->addSql('DROP TABLE jeu_categorie');
    }
}
