<?php


namespace App\Form\Handler;


use App\Entity\Commands;
use App\Entity\Tickets;
use App\Services\TicketsPrice;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class TicketsTypeHandler
{
    /**
     * @var ObjectManager
     */
    private $manager;
    /**
     * @var SessionInterface
     */
    private $session;

    public function __construct(ObjectManager $manager, SessionInterface $session, TicketsPrice $ticketsPrice)
    {
        $this->manager = $manager;
        $this->session = $session;
        $this->ticketsPrice = $ticketsPrice;
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

    public function TicketRequest($results, Commands $command)
    {
        foreach ($results as $r)
        {
            $amount = $this->ticketsPrice->priceCalcul($r, $command);
            $r->setPrice($amount);
            $command->addTicket($r);
            $this->manager->persist($command);
        }
        $this->manager->flush();
    }

}