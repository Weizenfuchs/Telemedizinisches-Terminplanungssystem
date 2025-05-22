<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Domain\Appointment\Service\CreateAppointment;
use Domain\Appointment\AppointmentRepositoryInterface;
use Domain\Appointment\Exception\InvalidAppointmentTimeException;
use Ramsey\Uuid\Uuid;

final class CreateAppointmentInvalidFormatTest extends TestCase
{
    public function testThrowsExceptionIfDateFormatIsInvalid(): void
    {
        $repo = $this->createMock(AppointmentRepositoryInterface::class);
        $service = new CreateAppointment($repo);

        $this->expectException(InvalidAppointmentTimeException::class);
        $this->expectExceptionMessage('Invalid date format');

        $service->create(
            Uuid::uuid4(),
            'Tank',
            'tank@zion.org',
            'not-a-date',
            'also-not-a-date'
        );
    }
}
