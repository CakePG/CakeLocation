<?php
use Migrations\AbstractMigration;

class CreateFlyers extends AbstractMigration
{
    public function change()
    {
        $table = $this->table('flyers');
        $table->addColumn('name', 'string', [
                'default' => null,
                'null' => false,
              ])
              ->addColumn('opened_at', 'datetime', [
                'null' => false,
              ])
              ->addColumn('closed_at', 'datetime', [
                'null' => false,
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

              ->addColumn('created', 'datetime', [
                'null' => false,
              ])
              ->addColumn('modified', 'datetime', [
                'null' => false,
              ])
              ->create();
    }
}
