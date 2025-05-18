<?php
declare(strict_types=1);

use Phinx\Seed\AbstractSeed;
use Ramsey\Uuid\Uuid;

final class TimeSlotsSeeder extends AbstractSeed
{
    public function getDependencies(): array
    {
        return [
            SpecializationsSeeder::class,
        ];
    }

    public function run(): void
    {
        $this->table('timeslots')->insert([
            [
                'id'           => Uuid::uuid4()->toString(),
                'doctor_id'    => Uuid::fromString(DoctorsSeeder::DOCTOR_1_ID),
                'weekday'      => 'Monday',
                'start_time'   => '09:00:00',
                'end_time'     => '12:00:00',
            ],
            [
                'id'           => Uuid::uuid4()->toString(),
                'doctor_id'    => Uuid::fromString(DoctorsSeeder::DOCTOR_1_ID),
                'weekday'      => 'Monday',
                'start_time'   => '13:00:00',
                'end_time'     => '15:00:00',
            ],
            [
                'id'           => Uuid::uuid4()->toString(),
                'doctor_id'    => Uuid::fromString(DoctorsSeeder::DOCTOR_1_ID),
                'weekday'      => 'Tuesday',
                'start_time'   => '09:00:00',
                'end_time'     => '15:00:00',
            ],
            [
                'id'           => Uuid::uuid4()->toString(),
                'doctor_id'    => Uuid::fromString(DoctorsSeeder::DOCTOR_1_ID),
                'weekday'      => 'Wednesday',
                'start_time'   => '09:00:00',
                'end_time'     => '15:00:00',
            ],
            [
                'id'           => Uuid::uuid4()->toString(),
                'doctor_id'    => Uuid::fromString(DoctorsSeeder::DOCTOR_1_ID),
                'weekday'      => 'Thursday',
                'start_time'   => '09:00:00',
                'end_time'     => '15:00:00',
            ],
            [
                'id'           => Uuid::uuid4()->toString(),
                'doctor_id'    => Uuid::fromString(DoctorsSeeder::DOCTOR_1_ID),
                'weekday'      => 'Friday',
                'start_time'   => '09:00:00',
                'end_time'     => '15:00:00',
            ],
            [
                'id'           => Uuid::uuid4()->toString(),
                'doctor_id'    => Uuid::fromString(DoctorsSeeder::DOCTOR_2_ID),
                'weekday'      => 'Monday',
                'start_time'   => '10:00:00',
                'end_time'     => '12:00:00',
            ],
            [
                'id'           => Uuid::uuid4()->toString(),
                'doctor_id'    => Uuid::fromString(DoctorsSeeder::DOCTOR_2_ID),
                'weekday'      => 'Tuesday',
                'start_time'   => '15:00:00',
                'end_time'     => '16:00:00',
            ]
        ])->save();
    }
}
