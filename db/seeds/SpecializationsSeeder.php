<?php

declare(strict_types=1);

use Phinx\Seed\AbstractSeed;
use Ramsey\Uuid\Uuid;

class SpecializationsSeeder extends AbstractSeed
{
    public const KARDIOLOGIE_ID = 'c118f91f-87c1-463d-ab8a-4bcc035113e2';
    public const NEUROLOGIE_ID = '8df9dd3d-4a76-44ef-a903-f011c3e3ead8';
    public const ORTHOPAEDIE_ID = 'febb72f7-cefd-455b-94d4-881286c6dbbe';

    public function run(): void
    {
        $data = [
            [
                'id' => Uuid::fromString(self::KARDIOLOGIE_ID),
                'name' => 'Kardiologie',
            ],
            [
                'id' => Uuid::fromString(self::NEUROLOGIE_ID),
                'name' => 'Neurologie',
            ],
            [
                'id' => Uuid::fromString(self::ORTHOPAEDIE_ID),
                'name' => 'Orthopädie',
            ],
        ];

        $this->table('specializations')->insert($data)->save();
    }
}
