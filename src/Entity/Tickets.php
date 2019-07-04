<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TicketsRepository")
 */
class Tickets
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Commands", inversedBy="tickets")
     * @ORM\JoinColumn(nullable=false)
     */
    private $command;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotNull(message="Veuillez remplir ce champ")
     * @Assert\Length(min = 2, max = 3, minMessage="", maxMessage="")
     */
    private $first_name;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotNull(message="Veuillez remplir ce champ")
     * @Assert\Length(min = 2, max = 3, minMessage="", maxMessage="")
     */
    private $last_name;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotNull(message="Veuillez remplir ce champ")
     * @Assert\Country
     */
    private $country;

    /**
     * @ORM\Column(type="datetime")
     * @Assert\NotNull(message="Veuillez remplir ce champ")
     * @Assert\DateTime
     */
    private $birth_date;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $discount;

    /**
     * @ORM\Column(type="integer")
     */
    private $price;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCommand(): ?Commands
    {
        return $this->command;
    }

    public function setCommand(?Commands $command): self
    {
        $this->command = $command;

        return $this;
    }

    public function getFirstName(): ?string
    {
        return $this->first_name;
    }

    public function setFirstName(string $first_name): self
    {
        $this->first_name = $first_name;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->last_name;
    }

    public function setLastName(string $last_name): self
    {
        $this->last_name = $last_name;

        return $this;
    }

    public function getCountry(): ?string
    {
        return $this->country;
    }

    public function setCountry(string $country): self
    {
        $this->country = $country;

        return $this;
    }

    public function getBirthDate(): ?\DateTime
    {
        return $this->birth_date;
    }

    public function setBirthDate(\DateTime $birth_date): self
    {
        $this->birth_date = $birth_date;

        return $this;
    }

    public function getDiscount()
    {
        return $this->discount;
    }

    public function setDiscount($discount): void
    {
        $this->discount = $discount;
    }

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setPrice(int $price): self
    {
        $this->price = $price;

        return $this;
    }
}
