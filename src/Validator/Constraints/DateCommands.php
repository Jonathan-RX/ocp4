<?php


namespace App\Validator\Constraints;


use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class DateCommands extends Constraint
{
    public $message = 'Reservation is not possible on a closing day';
}