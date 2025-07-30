<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250414074137 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE booking ADD CONSTRAINT FK_E00CEDDED434DE11 FOREIGN KEY (event_cat_id) REFERENCES event_cat (id)');
        $this->addSql('ALTER TABLE booking ADD CONSTRAINT FK_E00CEDDE67B3B43D FOREIGN KEY (users_id) REFERENCES user (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE booking DROP FOREIGN KEY FK_E00CEDDED434DE11');
        $this->addSql('ALTER TABLE booking DROP FOREIGN KEY FK_E00CEDDE67B3B43D');
    }
}
