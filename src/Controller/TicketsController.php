<?php

namespace App\Controller;

use App\Entity\Commands;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class TicketsController extends AbstractController{

    /**
    * @Route("/test/{id}", name="test")
    */
    public function test(Commands $commands){
    return $this->render('pages/test.html.twig', ['commands' => $commands]);
    }

}