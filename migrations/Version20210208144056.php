<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210208144056 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE category DROP FOREIGN KEY FK_64C19C1126EFEAA');
        $this->addSql('DROP INDEX IDX_64C19C1126EFEAA ON category');
        $this->addSql('ALTER TABLE category CHANGE cat_parent_id_id cat_parent_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE category ADD CONSTRAINT FK_64C19C19D2DF21F FOREIGN KEY (cat_parent_id) REFERENCES category (id)');
        $this->addSql('CREATE INDEX IDX_64C19C19D2DF21F ON category (cat_parent_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE category DROP FOREIGN KEY FK_64C19C19D2DF21F');
        $this->addSql('DROP INDEX IDX_64C19C19D2DF21F ON category');
        $this->addSql('ALTER TABLE category CHANGE cat_parent_id cat_parent_id_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE category ADD CONSTRAINT FK_64C19C1126EFEAA FOREIGN KEY (cat_parent_id_id) REFERENCES category (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_64C19C1126EFEAA ON category (cat_parent_id_id)');
    }
}
