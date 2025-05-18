<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class CreateAppointmentsTable extends AbstractMigration
{
    public function change(): void
    {
        $table = $this->table('appointments', ['id' => false, 'primary_key' => ['id']]);
        $table->addColumn('id', 'uuid')
              ->addColumn('doctor_id', 'uuid')
              ->addColumn('patient_name', 'string', ['limit' => 255])
              ->addColumn('patient_email', 'string', ['limit' => 255])
              ->addColumn('start_time', 'datetime')
              ->addColumn('end_time', 'datetime')
              ->addColumn('status', 'string', ['limit' => 20, 'default' => 'booked'])
              ->addForeignKey('doctor_id', 'doctors', 'id', ['delete'=> 'CASCADE', 'update'=> 'NO_ACTION'])
              ->create();
    }
}
