<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CommandsRepository")
 */
class Commands
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date_command;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date_visit;

    /**
     * @ORM\Column(type="boolean")
     * true for day
     * false for half day
     */
    private $duration;

    /**
     * @ORM\Column(type="boolean")
     */
    private $payment = false;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $mail;

    /**
     * @ORM\Column(type="integer")
     */
    private $nbr_tickets;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Tickets", mappedBy="command", cascade={"persist"})
     */
    private $tickets;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $order_number;

    public function __construct()
    {
        $this->tickets = new ArrayCollection();
        $this->date_command = new \DateTime();
        $this->order_number = ' ';
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateCommand(): ?\DateTimeInterface
    {
        return $this->date_command;
    }

    public function setDateCommand(\DateTimeInterface $date_command): self
    {
        $this->date_command = $date_command;

        return $this;
    }

    public function getDateVisit(): ?\DateTimeInterface
    {
        return $this->date_visit;
    }

    public function setDateVisit(\DateTimeInterface $date_visit): self
    {
        $this->date_visit = $date_visit;

        return $this;
    }

    public function getDuration()
    {
        return $this->duration;
    }

    public function setDuration($duration): void
    {
        $this->duration = $duration;
    }

    public function getPayment(): ?bool
    {
        return $this->payment;
    }

    public function setPayment(bool $payment): self
    {
        $this->payment = $payment;

        return $this;
    }

    public function getMail(): ?string
    {
        return $this->mail;
    }

    public function setMail(string $mail): self
    {
        $this->mail = $mail;

        return $this;
    }

    public function getNbrTickets()
    {
        return $this->nbr_tickets;
    }

    public function setNbrTickets($nbr_tickets): void
    {
        $this->nbr_tickets = $nbr_tickets;
    }

    public function getOrderNumber()
    {
        return $this->order_number;
    }

    public function setOrderNumber($order_number): void
    {
        $this->order_number = $order_number;
    }


    /**
     * @return Collection|Tickets[]
     */
    public function getTickets(): Collection
    {
        return $this->tickets;
    }

    public function addTicket(Tickets $ticket): self
    {
        if (!$this->tickets->contains($ticket)) {
            $this->tickets[] = $ticket;
            $ticket->setCommand($this);
        }

        return $this;
    }

    public function removeTicket(Tickets $ticket): self
    {
        if ($this->tickets->contains($ticket)) {
            $this->tickets->removeElement($ticket);
            // set the owning side to null (unless already changed)
            if ($ticket->getCommand() === $this) {
                $ticket->setCommand(null);
            }
        }

        return $this;
    }
}
