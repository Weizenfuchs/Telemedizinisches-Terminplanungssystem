<?php

declare(strict_types=1);

namespace Domain\Appointment\Exception;

use RuntimeException;

final class AppointmentNotFoundException extends RuntimeException
{
    public function __construct(string $message = 'Appointment not found', int $code = 404)
    {
        parent::__construct($message, $code);
    }
}
