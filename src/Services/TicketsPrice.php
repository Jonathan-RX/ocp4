<?php


namespace App\Services;


use App\Entity\Commands;
use App\Entity\Price;
use App\Entity\Tickets;
use Doctrine\ORM\EntityManager;

class TicketsPrice
{
    /**
     * @var EntityManager
     */
    private $em;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    public function priceCalcul(Tickets $tickets, Commands $commands){
        $prices = $this->em->getRepository(Price::class)->findOneById(1);
        $birthday = $tickets->getBirthDate();
        $diff = $birthday->diff(new \DateTime());
        $age = $diff->y;
        $discount = $tickets->getDiscount();
        $duration = $commands->getDuration();
        // Faire la condition pour savoir le prix -> $resultprice
        if($duration === false){
            $resultprice = $resultprice/2;
        }
        return $resultprice;
    }
}