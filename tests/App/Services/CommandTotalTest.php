<?php


namespace Test\App\Services;

use PHPUnit\Framework\TestCase;
use App\Services\CommandTotal;
use App\Entity\Commands;
use App\Entity\Tickets;


class CommandTotalTest extends TestCase
{
    public function testGetTotalATITwoTickets(){
        $command = new Commands();
        $command->setDateCommand(new \DateTime('2030-03-08'))->setDateVisit(New \DateTime('2030-03-08'))->setNbrTickets(2);
        $ticket1 = new Tickets();
        $ticket2 = new Tickets();
        $ticket1->setPrice(16);
        $ticket2->setPrice(16);
        $command->addTicket($ticket1);
        $command->addTicket($ticket2);

        $this->assertSame(32, CommandTotal::getTotalATI($command));
    }

    public function testgetTotalTaxesTwoTickets(){
        $command = new Commands();
        $command->setDateCommand(new \DateTime('2030-03-08'))->setDateVisit(New \DateTime('2030-03-08'))->setNbrTickets(2);
        $ticket1 = new Tickets();
        $ticket2 = new Tickets();
        $ticket1->setPrice(16);
        $ticket2->setPrice(16);
        $command->addTicket($ticket1);
        $command->addTicket($ticket2);

        $this->assertSame(5.34, CommandTotal::getTotalTaxes($command));
    }

    public function testgetTotalWTTwoTickets(){
        $command = new Commands();
        $command->setDateCommand(new \DateTime('2030-03-08'))->setDateVisit(New \DateTime('2030-03-08'))->setNbrTickets(2);
        $ticket1 = new Tickets();
        $ticket2 = new Tickets();
        $ticket1->setPrice(16);
        $ticket2->setPrice(16);
        $command->addTicket($ticket1);
        $command->addTicket($ticket2);

        $this->assertSame(26.66, CommandTotal::getTotalWT($command));
    }
}