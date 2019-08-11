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
            $priceATI += $t->getPrice();
        }

        return $priceATI;
    }

    public static function checkCommandHour(Commands $commands){
        $value = $commands->getDateVisit();
        $today = new \DateTime('today',new \DateTimeZone('Europe/Paris'));
        $interval = $today->diff($value);

        if($value < $today){
            return false;
        }
        if ($interval->days === 0 AND $today->format('h') > 17) {
            return false;
        }
        if($commands->getDuration() == true AND $interval->days === 0 AND date('H') > 13){
            return false;
        }
        return true;
    }

}