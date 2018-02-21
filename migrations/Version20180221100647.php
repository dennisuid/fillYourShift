<?php

namespace fillYourShift\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180221100647 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        $roles = [
            ['Fund Raiser', 'Raising Funds for Charity', '', 0, 4, 'Charities'],
            ['Office Administrator', 'Office Assistant at Retail locations', '', 0, 4, 'Charities'],
            ['Brochure Distributor', 'Markets Charituy initiatives', '', 0, 4, 'Charities'],
            ['Membership Administrator', 'Membership of supporters', '', 0, 4, 'Charities'],
            ['Brochure Distributor', 'Markets Charituy initiatives', '', 0, 4, 'Charities'],
            ['Brochure Distributor', 'Markets Charituy initiatives', '', 0, 4, 'Charities'],
            ['Tatcher', 'Tatching jobs', '', 0, 5, 'Construction'],
            ['Roofer', 'Roofing jobs', '', 0, 5, 'Construction'],
            ['Scaffolder', 'Scaffolding jobs', '', 0, 5, 'Construction'],
            ['Painter', 'Painting jobs', '', 0, 5, 'Construction'],
            ['Decorator', 'Decoratoring jobs', '', 0, 5, 'Construction'],
            ['Brick Layer', 'Brick Layering jobs', '', 0, 5, 'Construction'],
            ['Wood Machinist', 'Wood Machining jobs', '', 0, 5, 'Construction'],
            ['Floorers', 'Flooring jobs', '', 0, 5, 'Construction'],
            ['Glaziers', 'Glazing jobs', '', 0, 5, 'Construction'],
            ['Labourers', 'General labour at construction site', '', 0, 5, 'Construction'],
            ['Plumber', 'Plumbing jobs', '', 0, 5, 'Construction'],
            ['Air Conditioning', 'Air Conditioning jobs', '', 0, 5, 'Construction'],
            ['Material Handler', 'Material Handling jobs', '', 0, 2, 'WareHouses'],
            ['Cashier', 'Cashier at warehouse jobs', '', 0, 2, 'WareHouses'],
            ['Inventory Taker', 'Inventory Taking jobs', '', 0, 2, 'WareHouses'],
            ['Stock Associate', 'Stock Taking jobs', '', 0, 2, 'WareHouses'],
            ['Stocker', 'Stocking jobs', '', 0, 2, 'WareHouses'],
            ['Fork Lift Driver', 'Fork Lift Driving', '', 0, 2, 'WareHouses'],
            ['Packer', 'General Packing jobs', '', 0, 2, 'WareHouses'],
            ['Food Packager', 'Food item packaging jobs', '', 0, 2, 'WareHouses'],
            ['Waiter', 'Serving customers for food orders and serving', '', 0, 3, 'Restaurants'],
            ['Waitress', 'Serving customers for food orders and serving', '', 0, 3, 'Restaurants'],
            ['Food Server', 'Serving customers for food orders and serving', '', 0, 3, 'Restaurants'],
            ['Chef', 'Cooking delicious foods per order', '', 0, 3, 'Restaurants'],
            ['Cashier', 'Counter cash collection', '', 0, 3, 'Restaurants'],
            ['Bartender', 'Serving drinks of choice', '', 0, 3, 'Restaurants'],
            ['Counter Server', 'Over the counter server', '', 0, 3, 'Restaurants'],
            ['Dish Washer', 'Washing dishes and inventoy of dishes', '', 0, 3, 'Restaurants'],
            ['Kitchen Porter', 'Managing food and materials on kitchen', '', 0, 3, 'Restaurants'],
            ['Delivery', 'Delivery Boy', '', 0, 3, 'Restaurants'],
            ['Till Opertator', 'Manage checkout of customer baskets', '', 0, 1, 'Retail'],
            ['Customer Service', 'Support customer Service Queries and settlements', '', 0, 1, 'Retail'],
            ['Floor Assistant', 'Arrange materials in floor', '', 0, 1, 'Retail'],
            ['Display Assistant', 'Arrange Displays', '', 0, 1, 'Retail'],
            ['Order Filler', 'Helping providing order', '', 0, 1, 'Retail'],
            ['Retail Trainee', 'Help with general tasks', '', 0, 1, 'Retail'],
            ['Parking Assistant', 'Help with parking in the premises', '', 0, 1, 'Retail'],
            ['Inventory Taker', 'Delivery Boy', '', 0, 1, 'Retail']
            
        ];
    
        foreach ($roles as $role) {
            $sql = 'INSERT INTO fillyourshift.fys_role_employee(role_name, role_description, org_name, org_id, sector_id, sector_name) VALUES'
                    .'("'. $role[0].'","'. $role[1].'","'. $role[2].'","'. $role[3].'","'. $role[4].'","'. $role[5].'")';
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
