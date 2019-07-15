<?php


namespace App\Controller;


use App\Entity\Commands;
use App\Entity\Tickets;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class SummaryController extends AbstractController
{
    /**
     * @Route("/summary/{order_number}", name="summary")
     */
    public function summary(Request $request, Commands $commands)
    {

        $tickets = $commands->getTickets();
        $priceWT = \App\Services\CommandTotal::getTotalWT($commands);
        $taxes = \App\Services\CommandTotal::getTotalTaxes($commands);
        $priceATI = \App\Services\CommandTotal::getTotalATI($commands);

        return $this->render('pages/summary.html.twig',
            [
                'commands'=>$commands,
                'tickets'=>$tickets,
                'pricewt'=>$priceWT,
                'taxes'=>$taxes,
                'priceati'=>$priceATI,
            ]);
    }
}