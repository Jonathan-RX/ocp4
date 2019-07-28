<?php


namespace App\Controller;


use App\Entity\Commands;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\FrameworkBundle\Templating\EngineInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;

class StripeSuccessController extends AbstractController
{

    /**
     * @Route("/success/{order_number}", name="success")
     */
    public function StripeSuccess(Request $request, Commands $commands, EntityManagerInterface $em, \Swift_Mailer $mailer, Environment $twig){
        $validation = new \App\Services\StripeCheckout($em, $mailer, $twig);
        $validation->StripeEnablePaiement($commands);
        return $this->redirectToRoute('endcommand', ['order_number'=>$commands->getOrderNumber()]);
    }
}