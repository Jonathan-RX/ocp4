<?php


namespace App\Form\Handler;


use App\Entity\Commands;
use App\Entity\Tickets;
use Doctrine\Common\Persistence\ObjectManager;

class TicketsTypeHandler
{
    /**
     * @var ObjectManager
     */
    private $manager;

    public function __construct(ObjectManager $manager)
    {
        $this->manager = $manager;
    }

    public function generateTickets(Commands $commands)
    {
        $nbrTickets = $commands->getNbrTickets();
        $tickets = [];
        for($i = 1; $i <= $nbrTickets; $i++)
        {
            $tickets[] = new Tickets();
        }
        return $tickets;
    }


}