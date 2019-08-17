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
        $command->addTicket($ticket1)->addTicket($ticket2);

        $this->assertSame(32, CommandTotal::getTotalATI($command));
    }

    public function testgetTotalTaxesFiveTickets(){
        $command = new Commands();
        $command->setDateCommand(new \DateTime('2030-03-08'))->setDateVisit(New \DateTime('2030-03-08'))->setNbrTickets(2);
        $ticket1 = new Tickets();
        $ticket2 = new Tickets();
        $ticket3 = new Tickets();
        $ticket4 = new Tickets();
        $ticket5 = new Tickets();
        $ticket1->setPrice(0);
        $ticket2->setPrice(8);
        $ticket3->setPrice(10);
        $ticket4->setPrice(12);
        $ticket5->setPrice(16);
        $command->addTicket($ticket1)->addTicket($ticket2)->addTicket($ticket3)->addTicket($ticket4)->addTicket($ticket5);

        $this->assertSame(7.67, CommandTotal::getTotalTaxes($command));
    }

    public function testgetTotalWTThreeTickets(){
        $command = new Commands();
        $command->setDateCommand(new \DateTime('2030-03-08'))->setDateVisit(New \DateTime('2030-03-08'))->setNbrTickets(2);
        $ticket1 = new Tickets();
        $ticket2 = new Tickets();
        $ticket3 = new Tickets();
        $ticket1->setPrice(8);
        $ticket2->setPrice(10);
        $ticket3->setPrice(12);
        $command->addTicket($ticket1)->addTicket($ticket2)->addTicket($ticket3);

        $this->assertSame(25.0, CommandTotal::getTotalWT($command));
    }
}