<?php
declare(strict_types=1);

use Phinx\Seed\AbstractSeed;
use Ramsey\Uuid\Uuid;

final class TimeSlotsSeeder extends AbstractSeed
{
    public const SUNDAY = 0;
    public const MONDAY = 1;
    public const TUESDAY = 2;
    public const WEDNESDAY = 3;
    public const THURSDAY = 4;
    public const FRIDAY = 5;
    public const SATTURDAY = 6;

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
                'weekday'      => self::MONDAY,
                'start_time'   => '09:00:00',
                'end_time'     => '15:00:00',
            ],
            [
                'id'           => Uuid::uuid4()->toString(),
                'doctor_id'    => Uuid::fromString(DoctorsSeeder::DOCTOR_1_ID),
                'weekday'      => self::TUESDAY,
                'start_time'   => '09:00:00',
                'end_time'     => '15:00:00',
            ],
            [
                'id'           => Uuid::uuid4()->toString(),
                'doctor_id'    => Uuid::fromString(DoctorsSeeder::DOCTOR_1_ID),
                'weekday'      => self::WEDNESDAY,
                'start_time'   => '09:00:00',
                'end_time'     => '15:00:00',
            ],
            [
                'id'           => Uuid::uuid4()->toString(),
                'doctor_id'    => Uuid::fromString(DoctorsSeeder::DOCTOR_1_ID),
                'weekday'      => self::THURSDAY,
                'start_time'   => '09:00:00',
                'end_time'     => '15:00:00',
            ],
            [
                'id'           => Uuid::uuid4()->toString(),
                'doctor_id'    => Uuid::fromString(DoctorsSeeder::DOCTOR_1_ID),
                'weekday'      => self::FRIDAY,
                'start_time'   => '09:00:00',
                'end_time'     => '15:00:00',
            ],
            [
                'id'           => Uuid::uuid4()->toString(),
                'doctor_id'    => Uuid::fromString(DoctorsSeeder::DOCTOR_2_ID),
                'weekday'      => self::MONDAY,
                'start_time'   => '10:00:00',
                'end_time'     => '12:00:00',
            ],
            [
                'id'           => Uuid::uuid4()->toString(),
                'doctor_id'    => Uuid::fromString(DoctorsSeeder::DOCTOR_2_ID),
                'weekday'      => self::WEDNESDAY,
                'start_time'   => '15:00:00',
                'end_time'     => '16:00:00',
            ]
        ])->save();
    }
}
