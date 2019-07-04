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
     * @Route("/", name="home")
     */
    public function index(Request $request, CommandsTypeHandler $handler)
    {
        $commands = new Commands();
        $form = $this->createForm(CommandsType::class, $commands);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $handler->newCommand($commands);
            return $this->redirectToRoute('tickets', ['id'=>$commands->getId()]);
        }
        return $this->render('pages/home.html.twig', [
            'form' => $form->createView()
        ]);
    }

}