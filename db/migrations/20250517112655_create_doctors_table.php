<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class CreateDoctorsTable extends AbstractMigration
{
    public function change(): void
    {
        $table = $this->table('doctors', ['id' => false, 'primary_key' => 'id']);
        
        $table->addColumn('id', 'uuid')
              ->addColumn('name', 'string', ['limit' => 255])
              ->addColumn('specialization_id', 'uuid')
              ->addForeignKey('specialization_id', 'specializations', 'id', ['delete'=> 'CASCADE', 'update'=> 'NO_ACTION'])
              ->create();
    }
}
