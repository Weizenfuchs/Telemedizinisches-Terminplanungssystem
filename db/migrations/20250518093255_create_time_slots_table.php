<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class CreateTimeSlotsTable extends AbstractMigration
{
    public function change(): void
    {
        $table = $this->table('timeslots', ['id' => false, 'primary_key' => 'id']);
        
        $table->addColumn('id', 'uuid')
              ->addColumn('doctor_id', 'uuid')
              ->addColumn('weekday', 'string')
              ->addColumn('start_time', 'time')
              ->addColumn('end_time', 'time')
              ->addForeignKey('doctor_id', 'doctors', 'id', ['delete'=> 'CASCADE', 'update'=> 'NO_ACTION'])
              ->addIndex(['doctor_id'])
              ->create();
    }
}
