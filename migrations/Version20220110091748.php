<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220110091748 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE productadd ADD episode VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE wishlist_product ADD CONSTRAINT FK_4C46D2D718F84767 FOREIGN KEY (productadd_id) REFERENCES productadd (id)');
        $this->addSql('CREATE INDEX IDX_4C46D2D718F84767 ON wishlist_product (productadd_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE productadd DROP episode');
        $this->addSql('ALTER TABLE wishlist_product DROP FOREIGN KEY FK_4C46D2D718F84767');
        $this->addSql('DROP INDEX IDX_4C46D2D718F84767 ON wishlist_product');
    }
}
