<?php
use Migrations\AbstractMigration;

class CreateLocationsEmployments extends AbstractMigration
{
    public function change()
    {
        $table = $this->table('locations_employments');
        $table->addColumn('location_id', 'integer', [
                'null' => false,
              ])
              ->addColumn('employment_id', 'integer', [
                'null' => false,
              ])
              ->addForeignKey('location_id', 'locations', 'id', ['delete'=> 'CASCADE', 'update'=> 'CASCADE'])
              ->addForeignKey('employment_id', 'employments', 'id', ['delete'=> 'CASCADE', 'update'=> 'CASCADE'])
              ->create();
    }
}
