<?php

declare(strict_types=1);

namespace Domain\Appointment\Exception;

use RuntimeException;

final class AppointmentConflictException extends RuntimeException
{
    public function __construct(string $message = 'Appointment overlaps with an existing one', int $code = 409)
    {
        parent::__construct($message, $code);
    }
}
