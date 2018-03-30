<?php
use Migrations\AbstractMigration;

class CreateLocationsFlyers extends AbstractMigration
{
    public function change()
    {
        $table = $this->table('locations_flyers');
        $table->addColumn('location_id', 'integer', [
                'null' => false,
              ])
              ->addColumn('flyer_id', 'integer', [
                'null' => false,
              ])
              ->addForeignKey('location_id', 'locations', 'id', ['delete'=> 'CASCADE', 'update'=> 'CASCADE'])
              ->addForeignKey('flyer_id', 'flyers', 'id', ['delete'=> 'CASCADE', 'update'=> 'CASCADE'])
              ->create();
    }
}
