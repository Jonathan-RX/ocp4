<?php

namespace App\Controller;

use App\Entity\Commands;
use App\Form\Handler\TicketsTypeHandler;
use App\Form\TicketsType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class TicketsController extends AbstractController{

    /**
    * @Route("/tickets/{id}", name="tickets")
    */
    public function tickets(Request $request, Commands $commands, TicketsTypeHandler $ticketsHandler){
        $nbrTickets = $ticketsHandler->generateTickets($commands);
        $form = $this->createForm(CollectionType::class, $nbrTickets, [
            'entry_type' =>TicketsType::class
        ]);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $ticketsHandler->TicketRequest($nbrTickets, $commands);
            return $this->render('pages/summary.html.twig', [
                'form' => $form->createView()
            ]);

        }

        return $this->render('pages/tickets.html.twig', [
            'form' => $form->createView()
        ]);
    }

}