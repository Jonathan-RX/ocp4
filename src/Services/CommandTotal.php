<?php


namespace App\Services;


use App\Entity\Commands;
use Doctrine\ORM\EntityManagerInterface;

class CommandTotal
{

    public static function getTotalWT(Commands $commands){
        $tickets = $commands->getTickets();
        $priceWT = 0;

        foreach($tickets as $t){
            $priceWT += round(($t->getPrice()/1.2),2);
        }

        return $priceWT;
    }

    public static function getTotalTaxes(Commands $commands){
        $tickets = $commands->getTickets();
        $taxes = 0;

        foreach($tickets as $t){
            $taxes += round(($t->getPrice()/120 * 20), 2);
        }

        return $taxes;
    }

    public static function getTotalATI(Commands $commands){
        $tickets = $commands->getTickets();
        $priceATI = 0;

        foreach($tickets as $t){
            $priceATI = $t->getPrice();
        }

        return $priceATI;
    }

}