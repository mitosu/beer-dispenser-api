<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230105135727 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(
            'CREATE TABLE user (id VARCHAR(36) NOT NULL, 
            name VARCHAR(155) NOT NULL, 
            email VARCHAR(155) NOT NULL, 
            password VARCHAR(155) DEFAULT NULL, 
            token VARCHAR(155) DEFAULT NULL, 
            active TINYINT(1) NOT NULL DEFAULT 0, 
            reset_password_token VARCHAR(155) DEFAULT NULL, 
            created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP, 
            updated_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
            INDEX IDX_email_user (email),
            CONSTRAINT U_email_user UNIQUE KEY (email), 
            PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 
            COLLATE `utf8_unicode_ci` ENGINE = InnoDB'
        );
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE user');
    }
}
