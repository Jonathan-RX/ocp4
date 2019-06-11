<?php

namespace App\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class DateCommands extends Constraint
{
    public $message = 'La date de votre commande est indisponible';
    public $messageHourToday = 'La réservation pour le jour même est impossible après 18h.';
    public $messageHalfToday = 'La réservation pour une journée complète est impossible après 14h.';
    public $messagePastDate = 'La réservation pour une date passée est impossible.';

}