<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230117122801 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Dispense action operations table';
    }

    public function up(Schema $schema): void
    {
        $this->addSql(
            'CREATE TABLE dispense (id VARCHAR(36) NOT NULL, 
            dispenser_id VARCHAR(255) NOT NULL, 
            user_id VARCHAR(255) NOT NULL, 
            status TINYINT(1) NOT NULL, 
            created_at DATETIME NOT NULL, 
            PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB'
        );
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP TABLE dispense');
    }
}
