<?php

declare(strict_types=1);

use Phinx\Seed\AbstractSeed;
use Ramsey\Uuid\Uuid;

class AppointmentsSeeder extends AbstractSeed
{
    public function getDependencies(): array
    {
        return [
            DoctorsSeeder::class,
        ];
    }

    public function run(): void
    {
        $data = [
            [
                'id' => Uuid::uuid4()->toString(),
                'doctor_id' => Uuid::fromString(DoctorsSeeder::DOCTOR_1_ID),
                'patient_name' => 'Günter Jauch',
                'patient_email' => 'GuenterJauch@example.com',
                'start_time' => '2025-05-23 12:00:00',
                'end_time' => '2025-05-23 13:00:00',
                'status' => 'booked',
            ],
            [
                'id' => Uuid::uuid4()->toString(),
                'doctor_id' => Uuid::fromString(DoctorsSeeder::DOCTOR_1_ID),
                'patient_name' => 'Max Mustermann',
                'patient_email' => 'max.mustermann@example.com',
                'start_time' => '2025-05-23 10:00:00',
                'end_time' => '2025-05-23 11:00:00',
                'status' => 'booked',
            ],
            [
                'id' => Uuid::uuid4()->toString(),
                'doctor_id' => Uuid::fromString(DoctorsSeeder::DOCTOR_2_ID),
                'patient_name' => 'Erika Musterfrau',
                'patient_email' => 'erika.musterfrau@example.com',
                'start_time' => '2025-05-26 14:30:00',
                'end_time' => '2025-05-26 15:00:00',
                'status' => 'booked',
            ],
        ];

        $this->table('appointments')->insert($data)->saveData();
    }
}
