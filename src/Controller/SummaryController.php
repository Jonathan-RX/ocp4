<?php


namespace App\Controller;


use App\Entity\Commands;
use App\Entity\Tickets;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;

class SummaryController extends AbstractController
{
    /**
     * @Route("/summary/{order_number}", name="summary")
     */
    public function summary(Request $request, Commands $commands, EntityManagerInterface $em, \Swift_Mailer $mailer,  Environment $twig)
    {

        if($commands->getPayment() === true){
            return $this->redirectToRoute('endcommand', ['order_number'=>$commands->getOrderNumber()]);
        }

        if(!\App\Services\CommandTotal::checkCommandHour($commands)){
            $this->addFlash('error', 'The reservation for the requested date is impossible, please choose another date.');
            return $this->redirectToRoute('home', ['order_number'=>$commands->getOrderNumber()]);
        }

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