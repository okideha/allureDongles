<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200420154211 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE Categories (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE Clients (id INT AUTO_INCREMENT NOT NULL, first_name VARCHAR(255) NOT NULL, last_name VARCHAR(255) NOT NULL, adress VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, telephon VARCHAR(10) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE Commands (id INT AUTO_INCREMENT NOT NULL, id_client_id INT DEFAULT NULL, num_comm INT NOT NULL, date_comm INT NOT NULL, total_ht DOUBLE PRECISION NOT NULL, total_tva DOUBLE PRECISION NOT NULL, total_ttc DOUBLE PRECISION NOT NULL, INDEX IDX_6348717A99DED506 (id_client_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE CommandRows (id INT AUTO_INCREMENT NOT NULL, id_product_id INT NOT NULL, qte INT NOT NULL, pu DOUBLE PRECISION NOT NULL, tva INT NOT NULL, INDEX IDX_1A733E13E00EE68D (id_product_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE Products (id INT AUTO_INCREMENT NOT NULL, id_category_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, pa DOUBLE PRECISION NOT NULL, pv DOUBLE PRECISION NOT NULL, tva INT NOT NULL, stock INT NOT NULL, stkinit INT NOT NULL, stkal INT NOT NULL, INDEX IDX_4ACC380CA545015 (id_category_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE Commands ADD CONSTRAINT FK_6348717A99DED506 FOREIGN KEY (id_client_id) REFERENCES Clients (id)');
        $this->addSql('ALTER TABLE CommandRows ADD CONSTRAINT FK_1A733E13E00EE68D FOREIGN KEY (id_product_id) REFERENCES Products (id)');
        $this->addSql('ALTER TABLE Products ADD CONSTRAINT FK_4ACC380CA545015 FOREIGN KEY (id_category_id) REFERENCES Categories (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE Products DROP FOREIGN KEY FK_4ACC380CA545015');
        $this->addSql('ALTER TABLE Commands DROP FOREIGN KEY FK_6348717A99DED506');
        $this->addSql('ALTER TABLE CommandRows DROP FOREIGN KEY FK_1A733E13E00EE68D');
        $this->addSql('DROP TABLE Categories');
        $this->addSql('DROP TABLE Clients');
        $this->addSql('DROP TABLE Commands');
        $this->addSql('DROP TABLE CommandRows');
        $this->addSql('DROP TABLE Products');
    }
}
