<?php


namespace App\Validator\Constraints;


use App\Entity\Commands;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;

class DateCommandsValidator extends ConstraintValidator
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

        if (!$constraint instanceof DateCommands) {
            throw new UnexpectedTypeException($constraint, DateCommands::class);
        }

        if (null === $value || '' === $value) {
            return;
        }

        $day = $commands->getDateVisit()->format('d/m');
        $dayOfWeek = $commands->getDateVisit()->format('w');

        if ($day === '01/05' OR $day === '01/11' OR $day === '25/12') {
            $this->context->buildViolation($constraint->message)
                ->addViolation();
        }

        if ($dayOfWeek === '2' OR $dayOfWeek === '0') {
            $this->context->buildViolation($constraint->message)
                ->addViolation();
        }
    }
}