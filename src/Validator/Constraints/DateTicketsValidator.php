<?php


namespace App\Validator\Constraints;

use App\Entity\Commands;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;

class DateTicketsValidator extends ConstraintValidator
{
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function validate($value, Constraint $constraint)
    {
        $commands = $this->context->getObject();
        $repository = $this->em->getRepository(Commands::class);

        if (!$constraint instanceof DateTickets) {
            throw new UnexpectedTypeException($constraint, DateTickets::class);
        }
        $nbrTickets = $repository->countTicketsDay($value);
        dump($nbrTickets);
        if ($nbrTickets + $commands->getNbrTickets() > 1000) {
            $this->context->buildViolation($constraint->message)
                ->addViolation();
        }
    }
}