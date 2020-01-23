<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200123155626 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE book ADD release_date DATE DEFAULT NULL, ADD release_status TINYINT(1) NOT NULL, ADD status TINYINT(1) NOT NULL, ADD special TINYINT(1) NOT NULL');
        $this->addSql('ALTER TABLE series ADD finished TINYINT(1) NOT NULL');
        $this->addSql('ALTER TABLE user_book_collection ADD user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user_book_collection ADD CONSTRAINT FK_713C430EA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_713C430EA76ED395 ON user_book_collection (user_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE book DROP release_date, DROP release_status, DROP status, DROP special');
        $this->addSql('ALTER TABLE series DROP finished');
        $this->addSql('ALTER TABLE user_book_collection DROP FOREIGN KEY FK_713C430EA76ED395');
        $this->addSql('DROP INDEX IDX_713C430EA76ED395 ON user_book_collection');
        $this->addSql('ALTER TABLE user_book_collection DROP user_id');
    }
}
