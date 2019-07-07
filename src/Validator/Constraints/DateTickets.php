<?php


namespace App\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class DateTickets extends Constraint
{
    public $message = 'La date désirée ne dispose pas de suffisament de tickets disponibles.';
}