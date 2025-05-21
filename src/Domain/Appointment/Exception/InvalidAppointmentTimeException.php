<?php

declare(strict_types=1);

namespace Domain\Appointment\Exception;

use InvalidArgumentException;

final class InvalidAppointmentTimeException extends InvalidArgumentException
{
    public function __construct(string $message = 'Invalid appointment time', int $code = 400)
    {
        parent::__construct($message, $code);
    }
}
