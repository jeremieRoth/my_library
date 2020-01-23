<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200122175617 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE user_book_collection_book (user_book_collection_id INT NOT NULL, book_id INT NOT NULL, INDEX IDX_BB04CEDB98E4880A (user_book_collection_id), INDEX IDX_BB04CEDB16A2B381 (book_id), PRIMARY KEY(user_book_collection_id, book_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE user_book_collection_book ADD CONSTRAINT FK_BB04CEDB98E4880A FOREIGN KEY (user_book_collection_id) REFERENCES user_book_collection (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_book_collection_book ADD CONSTRAINT FK_BB04CEDB16A2B381 FOREIGN KEY (book_id) REFERENCES book (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE user_book_collection_book');
    }
}
