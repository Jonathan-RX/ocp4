<?php


namespace App\Form\Handler;


use App\Entity\Commands;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Request;

class CommandsTypeHandler
{
    /**
     * @var ObjectManager
     */
    private $objectManager;

    public function __construct(ObjectManager $objectManager)
    {
        $this->objectManager = $objectManager;
    }

    public function newCommand(Commands $commands, $request)
    {
        $session = $request->getSession();
        $session->set('commands', $commands);
        $this->objectManager->persist($commands);
        $this->objectManager->flush();
    }
}