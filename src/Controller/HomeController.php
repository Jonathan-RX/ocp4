<?php

namespace App\Controller;

use App\Entity\Commands;
use App\Form\CommandsType;
use App\Form\Handler\CommandsTypeHandler;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/{order_number}", defaults={"order_number"=null}, name="home")
     */
    public function index(Request $request, CommandsTypeHandler $handler, $order_number)
    {
        if($order_number === 'null'){
            $commands = new Commands();
        }else{
            $repository = $this->getDoctrine()->getRepository(Commands::class);
            $commands = $repository->findOneBy(['order_number'=>$order_number]);
        }
        $form = $this->createForm(CommandsType::class, $commands);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $handler->newCommand($commands);
            return $this->redirectToRoute('tickets', ['order_number'=>$commands->getOrderNumber()]);
        }
        return $this->render('pages/home.html.twig', [
            'form' => $form->createView()
        ]);
    }

}