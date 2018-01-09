<?php

namespace fillYourShift\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

class Version20171230160922 extends AbstractMigration
{

    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        $roles = [
            [1, 'employee', 'some body who does the work', 'test org'],
            [2, 'employer', 'some body who assigns the work', 'test org']
        ];
        foreach ($roles as $role) {
            $sql = 'INSERT INTO fillyourshift.fys_role(role_id, role_name, role_description, org_name) VALUES'
                    .'('.$role[0].',"'. $role[1].'","'. $role[2].'","'. $role[3].'")';
            echo $sql. "\n";
            $this->addSql($sql);
        }
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        $sql = "TRUNCATE table fillyourshift.fys_role";

        $this->addSql($sql);
    }

}
