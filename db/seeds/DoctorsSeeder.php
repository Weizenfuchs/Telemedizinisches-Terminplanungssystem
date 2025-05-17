<?php

declare(strict_types=1);

use Phinx\Seed\AbstractSeed;

class DoctorsSeeder extends AbstractSeed
{
    public const DOCTOR_1_ID = 'ef7216cd-1865-4da3-a7f1-79bc08d66151';
    public const DOCTOR_2_ID = '8d37bdab-367b-47f1-b9e6-53f63e918563';

    public function getDependencies(): array
    {
        return [
            SpecializationsSeeder::class,
        ];
    }

    public function run(): void
    {
        $data = [
            [
                'id' => self::DOCTOR_1_ID,
                'name' => 'Dr. Anna Müller',
                'specialization_id' => SpecializationsSeeder::KARDIOLOGIE_ID,
            ],
            [
                'id' => self::DOCTOR_2_ID,
                'name' => 'Dr. Max Mustermann',
                'specialization_id' => SpecializationsSeeder::NEUROLOGIE_ID,
            ],
        ];

        $this->table('doctors')->insert($data)->saveData();
    }
}
