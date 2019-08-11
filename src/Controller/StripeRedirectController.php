<?php


namespace App\Controller;

use App\Entity\Commands;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Twig\Environment;

class StripeRedirectController extends AbstractController
{

    /**
     * @Route("/striperedirect/{order_number}", name="striperedirect")
     */
    public function StripeRedirect(Request $request, Commands $commands, EntityManagerInterface $em, \Swift_Mailer $mailer, Environment $twig){

        if(\App\Services\CommandTotal::getTotalATI($commands) === 0){
            $validation = new \App\Services\StripeCheckout($em, $mailer, $twig);
            $validation->StripeEnablePaiement($commands);
            return $this->redirectToRoute('endcommand', ['order_number'=>$commands->getOrderNumber()]);
        }else{
            $session = \App\Services\StripeCheckout::StripeGetSession($commands,  $this->get('router'));

            return $this->render('pages/striperedirect.html.twig',
                [
                    'session'=>$session,
                ]);
            }
        }
}