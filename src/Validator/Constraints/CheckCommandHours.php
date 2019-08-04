<?php

namespace App\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class CheckCommandHours extends Constraint
{
    public $message = 'The date of your order is unavailable';
    public $messageHourToday = 'The reservation for the same day is impossible after 18h.';
    public $messageHalfToday = 'The booking for a full day is impossible after 14h.';
    public $messageToManyTickets = 'The desired date does not have enough tickets available.';

}