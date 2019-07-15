<?php


namespace App\Validator\Constraints;


use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class DateCommands extends Constraint
{
    public $message = 'La réservation est impossible un jour de fermeture';
}