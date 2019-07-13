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
        $priceWT = 0;
        $taxes = 0;

        foreach($tickets as $t){
            $priceWT += round(($t->getPrice()/1.2),2);
            $taxes += round(($priceWT * 0.2), 2);
            $priceATI = $t->getPrice();
        }

        \Stripe\Stripe::setApiKey('sk_test_UJYp1WP5IrUlZuTUpbmKjXX400JZdbgQzq');
        $session = \Stripe\Checkout\Session::create([
            'payment_method_types' => ['card'],
            'line_items' => [[
                'name' => 'Réservation de tickets',
                'amount' => $priceATI*100,
                'currency' => 'eur',
                'quantity' => 1,
            ]],
            'success_url' => 'https://example.com/success',
            'cancel_url' => 'https://example.com/cancel',
        ]);
        dump($session);

        return $this->render('pages/summary.html.twig',
            [
                'commands'=>$commands,
                'tickets'=>$tickets,
                'pricewt'=>$priceWT,
                'taxes'=>$taxes,
                'priceati'=>$priceATI,
                'session'=>$session
            ]);
    }
}