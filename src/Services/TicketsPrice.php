<?php


namespace App\Services;


use App\Entity\Commands;
use App\Entity\Price;
use App\Entity\Tickets;
use Doctrine\ORM\EntityManagerInterface;

class TicketsPrice
{

    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function priceCalcul(Tickets $tickets, Commands $commands){
        $prices = $this->entityManager->getRepository(Price::class)->findPrice();
        $birthday = $tickets->getBirthDate();
        $diff = $birthday->diff($commands->getDateVisit());
        $age = $diff->y;

        $duration = $commands->getDuration();
        $resultprice = $prices->getRegular();
        if($age < 4){$resultprice = $prices->getFree();}
        if($age >= 4 && $age < 12){$resultprice = $prices->getChild();}
        if($age >= 60){$resultprice = $prices->getSenior();}
        if($tickets->getDiscount() === true && $resultprice > $prices->getDiscount()){
            $resultprice = $prices->getDiscount();
        }
        if($duration === false){
            $resultprice = $resultprice/2;
        }
        return $resultprice;
    }
}