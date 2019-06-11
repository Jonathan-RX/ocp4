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
        if (!$constraint instanceof DateCommands) {
            throw new UnexpectedTypeException($constraint, DateCommands::class);
        }

        if (null === $value || '' === $value) {
            return;
        }

        $today = new \DateTime('today',new \DateTimeZone('Europe/Paris'));
        $interval = $today->diff($value);
        $commands = $this->context->getObject();
        $repository = $this->em->getRepository(Commands::class);

        // Check Hour for today
        if ($interval->days === 0 AND $today->format('h') > 18) {
            $this->context->buildViolation($constraint->messageHourToday)
                ->addViolation();
        }
        if($commands->getDuration() == true AND $interval->days === 0 AND date('H') > 13){
            $this->context->buildViolation($constraint->messageHalfToday)
                ->addViolation();
        }

        // Check past date
        if ($interval->days < 0) {
            $this->context->buildViolation($constraint->messagePastDate)
                ->addViolation();
        }

        // Check number tickets by date
        //$nbrTickets = $repository->count(['date_visit' => $value]);
        $nbrTickets = $repository->createQueryBuilder('v')
            ->select('COUNT(v)')
            ->leftJoin('v.tickets', 'e')
            ->where('v.date_visit = :value');
        dump($nbrTickets);
        dump($value->format('Y-m-d 00:00:00'));
    }
}