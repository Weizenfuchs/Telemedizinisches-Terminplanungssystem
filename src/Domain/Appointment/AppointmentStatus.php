<?php

namespace Domain\Appointment;

enum AppointmentStatus: string
{
    case BOOKED = 'booked';
    case CANCELLED = 'cancelled';
    case COMPLETED = 'completed';
}
