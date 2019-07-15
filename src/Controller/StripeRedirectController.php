<?php


namespace App\Controller;

use App\Entity\Commands;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class StripeRedirectController extends AbstractController
{

    /**
     * @Route("/striperedirect/{order_number}", name="striperedirect")
     */
    public function StripeRedirect(Request $request, Commands $commands){

        $session = \App\Services\StripeCheckout::StripeGetSession($commands,  $this->get('router'));

        return $this->render('pages/striperedirect.html.twig',
            [
                'session'=>$session,
            ]);
    }
}