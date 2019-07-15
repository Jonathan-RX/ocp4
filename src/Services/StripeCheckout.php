<?php


namespace App\Services;

use App\Entity\Commands;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class StripeCheckout
{

    public static function StripeGetSession(Commands $commands, $router){
        $priceATI =  \App\Services\CommandTotal::getTotalATI($commands);
        \Stripe\Stripe::setApiKey('sk_test_UJYp1WP5IrUlZuTUpbmKjXX400JZdbgQzq');
        $session = \Stripe\Checkout\Session::create([
            'payment_method_types' => ['card'],
            'line_items' => [[
                'name' => 'Réservation de tickets',
                'images' => ['http://jiajuanli.eu/wp-content/uploads/2017/04/Louvre-LOGO.png'],
                'description'=> 'Réservation de vos tickets pour la visite du ' . $commands->getDateVisit()->format('d/m/Y') . '.',
                'amount' => $priceATI*100,
                'customer_email' => $commands->getMail(),
                'currency' => 'eur',
                'quantity' => 1,
            ]],
            'success_url' => $router->generate('success', ['order_number'=>$commands->getOrderNumber()], UrlGeneratorInterface::ABSOLUTE_URL),
            'cancel_url' => $router->generate('summary', ['order_number'=>$commands->getOrderNumber()], UrlGeneratorInterface::ABSOLUTE_URL),
        ]);
        return $session;
    }
}