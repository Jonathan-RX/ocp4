<?php
namespace App\Validator\Constraints;

use App\Entity\Commands;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;

class CheckCommandHoursValidator extends ConstraintValidator
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

        if (!$constraint instanceof CheckCommandHours) {
            throw new UnexpectedTypeException($constraint, CheckCommandHours::class);
        }

        if (null === $value || '' === $value) {
            return;
        }

        $today = new \DateTime('today',new \DateTimeZone('Europe/Paris'));
        $interval = $today->diff($value);

        if ($interval->days === 0 AND $today->format('h') > 17) {
            $this->context->buildViolation($constraint->messageHourToday)
                ->addViolation();
        }
        if($commands->getDuration() == true AND $interval->days === 0 AND date('H') > 13){
            $this->context->buildViolation($constraint->messageHalfToday)
                ->addViolation();
        }

    }
}