<?php

declare(strict_types=1);

use Phinx\Seed\AbstractSeed;

class SpecializationsSeeder extends AbstractSeed
{
    public const KARDIOLOGIE_ID = '524b62cd-6583-4c8d-9827-9b4a73b66064';
    public const NEUROLOGIE_ID = '0df963cc-209f-44fa-aeb6-89e27fde8562';
    public const ORTHOPAEDIE_ID = 'edd3502c-2bda-4238-8fd4-afbb2567d6ed';

    public function run(): void
    {
        $data = [
            [
                'id' => self::KARDIOLOGIE_ID,
                'name' => 'Kardiologie',
            ],
            [
                'id' => self::NEUROLOGIE_ID,
                'name' => 'Neurologie',
            ],
            [
                'id' => self::ORTHOPAEDIE_ID,
                'name' => 'Orthopädie',
            ],
        ];

        $this->table('specializations')->insert($data)->save();
    }
}
