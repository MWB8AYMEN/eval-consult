<?php

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180517150922 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE category DROP FOREIGN KEY FK_64C19C112469DE2');
        $this->addSql('CREATE TABLE user_category (category_id INT NOT NULL, user_id INT NOT NULL, note INT DEFAULT NULL, inserted_at DATETIME DEFAULT NULL, INDEX IDX_E6C1FDC1A76ED395 (user_id), PRIMARY KEY(category_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE user_category ADD CONSTRAINT FK_E6C1FDC112469DE2 FOREIGN KEY (category_id) REFERENCES category (id)');
        $this->addSql('ALTER TABLE user_category ADD CONSTRAINT FK_E6C1FDC1A76ED395 FOREIGN KEY (user_id) REFERENCES fos_user (id)');
        $this->addSql('DROP TABLE categorie');
        $this->addSql('ALTER TABLE category DROP FOREIGN KEY FK_64C19C1A76ED395');
        $this->addSql('DROP INDEX IDX_64C19C1A76ED395 ON category');
        $this->addSql('DROP INDEX IDX_64C19C112469DE2 ON category');
        $this->addSql('ALTER TABLE category DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE category ADD id INT AUTO_INCREMENT NOT NULL, ADD name VARCHAR(45) DEFAULT NULL, ADD description VARCHAR(255) DEFAULT NULL, DROP user_id, DROP category_id');
        $this->addSql('ALTER TABLE category ADD PRIMARY KEY (id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE categorie (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(45) DEFAULT NULL COLLATE utf8mb4_unicode_ci, description VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('DROP TABLE user_category');
        $this->addSql('ALTER TABLE category MODIFY id INT NOT NULL');
        $this->addSql('ALTER TABLE category DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE category ADD user_id INT NOT NULL, ADD category_id INT NOT NULL, DROP id, DROP name, DROP description');
        $this->addSql('ALTER TABLE category ADD CONSTRAINT FK_64C19C112469DE2 FOREIGN KEY (category_id) REFERENCES categorie (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE category ADD CONSTRAINT FK_64C19C1A76ED395 FOREIGN KEY (user_id) REFERENCES fos_user (id) ON DELETE CASCADE');
        $this->addSql('CREATE INDEX IDX_64C19C1A76ED395 ON category (user_id)');
        $this->addSql('CREATE INDEX IDX_64C19C112469DE2 ON category (category_id)');
        $this->addSql('ALTER TABLE category ADD PRIMARY KEY (user_id, category_id)');
    }
}
