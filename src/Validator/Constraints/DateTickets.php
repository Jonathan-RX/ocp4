<?php


namespace App\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class DateTickets extends Constraint
{
    public $message = 'The desired date does not have enough tickets available.';
}