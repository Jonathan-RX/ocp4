<?php


namespace App\Services;

use App\Entity\Commands;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Templating\EngineInterface;
use Symfony\Bundle\TwigBundle\DependencyInjection\TwigExtension;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Twig\Environment;

class StripeCheckout extends TwigExtension
{

    /**
     * @var EntityManagerInterface
     */
    private $entityManager;
    /**
     * @var \Swift_Mailer
     */
    private $mailer;
    /**
     * @var Environment
     */
    private $twig;

    public function __construct(EntityManagerInterface $entityManager, \Swift_Mailer $mailer, Environment $twig)
    {
        $this->entityManager = $entityManager;
        $this->mailer = $mailer;
        $this->twig = $twig;
    }

    public static function StripeGetSession(Commands $commands, $router){
        $priceATI =  \App\Services\CommandTotal::getTotalATI($commands);
        \Stripe\Stripe::setApiKey('sk_test_UJYp1WP5IrUlZuTUpbmKjXX400JZdbgQzq');
        $session = \Stripe\Checkout\Session::create([
            'payment_method_types' => ['card'],
            'customer_email' => $commands->getMail(),
            'line_items' => [[
                'name' => 'Réservation de tickets',
                'images' => ['http://jiajuanli.eu/wp-content/uploads/2017/04/Louvre-LOGO.png'],
                'description'=> 'Réservation de vos tickets pour la visite du ' . $commands->getDateVisit()->format('d/m/Y') . '.',
                'amount' => $priceATI*100,
                'currency' => 'eur',
                'quantity' => 1,
            ]],
            'success_url' => $router->generate('success', ['order_number'=>$commands->getOrderNumber()], UrlGeneratorInterface::ABSOLUTE_URL),
            'cancel_url' => $router->generate('summary', ['order_number'=>$commands->getOrderNumber()], UrlGeneratorInterface::ABSOLUTE_URL),
        ]);
        return $session;
    }

    public function StripeEnablePaiement(Commands $commands){
        $commands->setPayment(true);
        $this->entityManager->persist($commands);
        $this->entityManager->flush();
        /*
         * Envoi du mail
         */
        $message = (new \Swift_Message('Votre réservation pour le musée du louvre'))
            ->setFrom('jr.poub@gmail.com')
            ->setTo($commands->getMail())
            ->setBody(
                $this->twig->render(
                    'emails/commands.html.twig',
                    ['commands' => $commands]
                ),
                'text/html'
            );
        $this->mailer->send($message);

        return true;
    }
}