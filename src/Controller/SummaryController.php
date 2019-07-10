<?php


namespace App\Controller;


use App\Entity\Commands;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class SummaryController extends AbstractController
{
    /**
     * @Route("/summary", name="summary")
     */
    public function summary(Request $request, Commands $commands)
    {
        return $this->render('pages/summary.html.twig');
    }
}