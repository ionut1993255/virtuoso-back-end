<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230312161030 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE note ADD song_id INT DEFAULT NULL, DROP song');
        $this->addSql('ALTER TABLE note ADD CONSTRAINT FK_CFBDFA14A0BDB2F3 FOREIGN KEY (song_id) REFERENCES song (id)');
        $this->addSql('CREATE INDEX IDX_CFBDFA14A0BDB2F3 ON note (song_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE note DROP FOREIGN KEY FK_CFBDFA14A0BDB2F3');
        $this->addSql('DROP INDEX IDX_CFBDFA14A0BDB2F3 ON note');
        $this->addSql('ALTER TABLE note ADD song VARCHAR(255) NOT NULL, DROP song_id');
    }
}
