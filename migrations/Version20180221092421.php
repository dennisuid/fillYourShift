<?php

namespace fillYourShift\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180221092421 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        $sectors = [
            [1, 'Retail'],
            [2, 'WareHouses'],
            [3,'Restaurants'],
            [4,'Charities'],
            [5,'Construction'],
        ];
        foreach ($sectors as $sector) {
            $sql = "INSERT INTO fillyourshift.org_sector(id,sector_name) VALUES ($sector[0],'$sector[1]')";
            echo $sql. "\n";
            $this->addSql($sql);
        }
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $sql = "TRUNCATE table fillyourshift.org_sector";

        $this->addSql($sql);
    }
}
