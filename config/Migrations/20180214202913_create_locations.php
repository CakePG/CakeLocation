<?php
use Migrations\AbstractMigration;

class CreateLocations extends AbstractMigration
{
    public function change()
    {
        $table = $this->table('locations');
        $table->addColumn('name', 'string', [
                'default' => null,
                'null' => true,
              ])
              ->addColumn('postal', 'string', [
                'default' => null,
                'null' => true,
              ])
              ->addColumn('address', 'string', [
                'default' => null,
                'null' => true,
              ])
              ->addColumn('tel', 'string', [
                'default' => null,
                'null' => true,
              ])
              ->addColumn('fax', 'string', [
                'default' => null,
                'null' => true,
              ])
              ->addColumn('hour', 'string', [
                'default' => null,
                'null' => true,
              ])
              ->addColumn('holiday', 'string', [
                'default' => null,
                'null' => true,
              ])
              ->addColumn('link1', 'string', [
                'default' => null,
                'null' => true,
              ])
              ->addColumn('link2', 'string', [
                'default' => null,
                'null' => true,
              ])

              ->addColumn('description', 'text', [
                'default' => null,
                'null' => true,
              ])

              ->addColumn('file1', 'string', [
                  'default' => null,
                  'null' => true,
              ])
              ->addColumn('dir1', 'string', [
                  'default' => null,
                  'null' => true,
              ])
              ->addColumn('size1', 'string', [
                  'default' => null,
                  'null' => true,
              ])
              ->addColumn('type1', 'string', [
                  'default' => null,
                  'null' => true,
              ])

              ->addColumn('file2', 'string', [
                  'default' => null,
                  'null' => true,
              ])
              ->addColumn('dir2', 'string', [
                  'default' => null,
                  'null' => true,
              ])
              ->addColumn('size2', 'string', [
                  'default' => null,
                  'null' => true,
              ])
              ->addColumn('type2', 'string', [
                  'default' => null,
                  'null' => true,
              ])

              ->addColumn('priority', 'integer', [
                'default' => 0,
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
