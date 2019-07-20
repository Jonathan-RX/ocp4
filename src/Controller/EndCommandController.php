<?php


namespace App\Controller;


use App\Entity\Commands;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class EndCommandController extends AbstractController
{

    /**
     * @Route("/endcommand/{order_number}", name="endcommand")
     */
    public function EndCommand(Request $request, Commands $commands){
        return $this->render('pages/endcommand.html.twig',
            [
                'commands'=>$commands,
            ]);
    }


}