<?php

namespace fillYourShift\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180221121234 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        $roles = [
            ['SHIFT_CREATED', 'SHIFT'],
            ['SHIFT_MODIFIED', 'SHIFT'],
            ['SHIFT_PUBLISHED', 'SHIFT'],
            ['SHIFT_SUBCRIBED', 'SHIFT'],
            ['SHIFT_APPROVED', 'SHIFT'],
            ['SHIFT_ACCEPTED', 'SHIFT'],
            ['SHIFT_REJECTED', 'SHIFT'],
            ['SHIFT_DELETED', 'SHIFT'],
            ['SHIFT_CHECKEDIN', 'SHIFT'],
            ['SHIFT_COMPLETED', 'SHIFT'],
            ['SHIFT_REVIEW-BY_EMPLOYER', 'SHIFT'],
            ['SHIFT_REVIEW-BY_EMPLOYEE', 'SHIFT'],
            ['SHIFT_PAYMENT_APPROVAL', 'SHIFT'],
            ['SHIFT_ARCHIVE', 'SHIFT'],
            ['USER_LOGGEDIN', 'USER'],
            ['USER_LOGGEDOUT', 'USER'],
            ['USER_PROFILE_UPDATED', 'USER'],
            ['USER_ALERT_UPDATED', 'USER'],
            ['USER_RESUME_UPDATED', 'USER'],
            ['USER_SECTOR_CHANGED', 'USER'],
            ['USER_ROLE_CHANGED', 'USER'],
            ['USER_ADDRESS_CHANGED', 'USER']
            
        ];
    
        foreach ($roles as $role) {
            $sql = 'INSERT INTO fillyourshift.event_meta_data(event_name, event_object_type) VALUES'
                    .'("'. $role[0].'","'. $role[1].'")';
            echo $sql. "\n";
            $this->addSql($sql);
        }
    }
    
    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        $sql = "TRUNCATE table fillyourshift.event_meta_data";

        $this->addSql($sql);

    }
}
