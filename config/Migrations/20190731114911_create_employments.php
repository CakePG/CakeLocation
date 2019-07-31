<?php
use Migrations\AbstractMigration;

class CreateEmployments extends AbstractMigration
{
    public function change()
    {
        $table = $this->table('employments');
        $table->addColumn('name', 'string', [
                'default' => null,
                'null' => false,
              ])

              ->addColumn('created', 'datetime', [
                'null' => false,
              ])
              ->addColumn('modified', 'datetime', [
                'null' => false,
              ])
              ->create();
    }
}
