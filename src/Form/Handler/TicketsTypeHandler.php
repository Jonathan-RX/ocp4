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
        $ticketsLoaded = $commands->getTickets();
        foreach ($ticketsLoaded as $t){
            $this->manager->remove($t);
        }
        $tickets = [];
        for ($i = 0; $i < $nbrTickets; $i++) {
            if($ticketsLoaded[$i] === null){
                $tickets[] = new Tickets();
            }else {
                $tickets[] = $ticketsLoaded[$i];
                $this->manager->persist($tickets[$i]);
            }
        }
        $this->manager->flush();
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