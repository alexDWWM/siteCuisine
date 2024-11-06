<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241106074350 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE quantite (id INT AUTO_INCREMENT NOT NULL, ingredient_id INT DEFAULT NULL, recette_id INT DEFAULT NULL, unite_id INT DEFAULT NULL, quantite DOUBLE PRECISION NOT NULL, INDEX IDX_8BF24A79933FE08C (ingredient_id), INDEX IDX_8BF24A7989312FE9 (recette_id), INDEX IDX_8BF24A79EC4A74AB (unite_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE quantite ADD CONSTRAINT FK_8BF24A79933FE08C FOREIGN KEY (ingredient_id) REFERENCES ingredient (id)');
        $this->addSql('ALTER TABLE quantite ADD CONSTRAINT FK_8BF24A7989312FE9 FOREIGN KEY (recette_id) REFERENCES recette (id)');
        $this->addSql('ALTER TABLE quantite ADD CONSTRAINT FK_8BF24A79EC4A74AB FOREIGN KEY (unite_id) REFERENCES unite_de_mesure (id)');
        $this->addSql('ALTER TABLE categorie CHANGE thumbnail thumbnail VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE ingredient DROP FOREIGN KEY FK_6BAF7870D1BC2C70');
        $this->addSql('DROP INDEX IDX_6BAF7870D1BC2C70 ON ingredient');
        $this->addSql('ALTER TABLE ingredient DROP unite_de_mesure_id');
        $this->addSql('ALTER TABLE recette_ingredient DROP FOREIGN KEY FK_17C041A989312FE9');
        $this->addSql('ALTER TABLE recette_ingredient DROP FOREIGN KEY FK_17C041A9933FE08C');
        $this->addSql('ALTER TABLE recette_ingredient ADD id INT AUTO_INCREMENT NOT NULL, ADD quantite DOUBLE PRECISION DEFAULT NULL, CHANGE recette_id recette_id INT DEFAULT NULL, CHANGE ingredient_id ingredient_id INT DEFAULT NULL, DROP PRIMARY KEY, ADD PRIMARY KEY (id)');
        $this->addSql('ALTER TABLE recette_ingredient ADD CONSTRAINT FK_17C041A989312FE9 FOREIGN KEY (recette_id) REFERENCES recette (id)');
        $this->addSql('ALTER TABLE recette_ingredient ADD CONSTRAINT FK_17C041A9933FE08C FOREIGN KEY (ingredient_id) REFERENCES ingredient (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE quantite DROP FOREIGN KEY FK_8BF24A79933FE08C');
        $this->addSql('ALTER TABLE quantite DROP FOREIGN KEY FK_8BF24A7989312FE9');
        $this->addSql('ALTER TABLE quantite DROP FOREIGN KEY FK_8BF24A79EC4A74AB');
        $this->addSql('DROP TABLE quantite');
        $this->addSql('ALTER TABLE categorie CHANGE thumbnail thumbnail VARCHAR(1000) NOT NULL');
        $this->addSql('ALTER TABLE ingredient ADD unite_de_mesure_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE ingredient ADD CONSTRAINT FK_6BAF7870D1BC2C70 FOREIGN KEY (unite_de_mesure_id) REFERENCES unite_de_mesure (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_6BAF7870D1BC2C70 ON ingredient (unite_de_mesure_id)');
        $this->addSql('ALTER TABLE recette_ingredient MODIFY id INT NOT NULL');
        $this->addSql('ALTER TABLE recette_ingredient DROP FOREIGN KEY FK_17C041A989312FE9');
        $this->addSql('ALTER TABLE recette_ingredient DROP FOREIGN KEY FK_17C041A9933FE08C');
        $this->addSql('DROP INDEX `PRIMARY` ON recette_ingredient');
        $this->addSql('ALTER TABLE recette_ingredient DROP id, DROP quantite, CHANGE recette_id recette_id INT NOT NULL, CHANGE ingredient_id ingredient_id INT NOT NULL');
        $this->addSql('ALTER TABLE recette_ingredient ADD CONSTRAINT FK_17C041A989312FE9 FOREIGN KEY (recette_id) REFERENCES recette (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE recette_ingredient ADD CONSTRAINT FK_17C041A9933FE08C FOREIGN KEY (ingredient_id) REFERENCES ingredient (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE recette_ingredient ADD PRIMARY KEY (recette_id, ingredient_id)');
    }
}
