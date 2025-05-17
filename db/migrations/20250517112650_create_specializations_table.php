<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class CreateSpecializationsTable extends AbstractMigration
{    
    public function change(): void
    {
        $table = $this->table('specializations', ['id' => false, 'primary_key' => 'id']);

        $table->addColumn('id', 'uuid')
              ->addColumn('name', 'string', ['limit' => 255])
              ->create();
    }
}
