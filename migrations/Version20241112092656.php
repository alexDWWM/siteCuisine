<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241112092656 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE etapes DROP FOREIGN KEY FK_E3443E1789312FE9');
        $this->addSql('DROP INDEX IDX_E3443E1789312FE9 ON etapes');
        $this->addSql('ALTER TABLE etapes ADD etapes VARCHAR(255) NOT NULL, DROP recette_id, DROP etape');
        $this->addSql('ALTER TABLE saison ADD date_debut DATE DEFAULT NULL, ADD date_fin DATE DEFAULT NULL, ADD image VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE etapes ADD recette_id INT DEFAULT NULL, ADD etape VARCHAR(500) NOT NULL, DROP etapes');
        $this->addSql('ALTER TABLE etapes ADD CONSTRAINT FK_E3443E1789312FE9 FOREIGN KEY (recette_id) REFERENCES recette (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_E3443E1789312FE9 ON etapes (recette_id)');
        $this->addSql('ALTER TABLE saison DROP date_debut, DROP date_fin, DROP image');
    }
}
