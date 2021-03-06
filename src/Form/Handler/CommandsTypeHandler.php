<?php


namespace App\Form\Handler;


use App\Entity\Commands;
use Doctrine\Common\Persistence\ObjectManager;
use Ramsey\Uuid\Uuid;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class CommandsTypeHandler
{
    /**
     * @var ObjectManager
     */
    private $objectManager;
    /**
     * @var SessionInterface
     */
    private $session;

    public function __construct(ObjectManager $objectManager, SessionInterface $session)
    {
        $this->objectManager = $objectManager;
        $this->session = $session;
    }

    public function newCommand(Commands $commands)
    {
        $orderNumber = Uuid::uuid4();
        $commands->setOrderNumber($orderNumber);
        $this->session->set('commands', $commands);
        $this->objectManager->persist($commands);
        $this->objectManager->flush();
    }
}