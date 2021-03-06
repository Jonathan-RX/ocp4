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
     * @Assert\NotNull(message="Please fill in this field")
     * @Assert\Length(min = 2, max = 50, minMessage="Please fill in this field", maxMessage="Your name is too long")
     * @Assert\Regex(
     *     pattern="/^[a-zA-Z0-9áàâäãåçéèêëíìîïñóòôöõúùûüýÿæœÁÀÂÄÃÅÇÉÈÊËÍÌÎÏÑÓÒÔÖÕÚÙÛÜÝŸÆŒ._\s-]+$/i",
     *     message="Your name can content only letters and hyphens")
     */
    private $first_name;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotNull(message="Please fill in this field")
     * @Assert\Length(min = 2, max = 50, minMessage="Please fill in this field", maxMessage="Your name is too long")
     * @Assert\Regex(
     *     pattern="/^[a-zA-Z0-9áàâäãåçéèêëíìîïñóòôöõúùûüýÿæœÁÀÂÄÃÅÇÉÈÊËÍÌÎÏÑÓÒÔÖÕÚÙÛÜÝŸÆŒ._\s-]+$/i",
     *     message="Your name can content only letters and hyphens")
     */
    private $last_name;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotNull(message="Please fill in this field")
     * @Assert\Country
     */
    private $country;

    /**
     * @ORM\Column(type="datetime")
     * @Assert\NotNull(message="Please fill in this field")
     * @Assert\LessThan("today", message="The date of birth must be less than the current date.")
     * @Assert\GreaterThan("01/01/1900 UTC", message="The date must be greater than 01 January 1900")
     * @Assert\DateTime
     */
    private $birth_date;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     * @Assert\NotNull(message="An error occurred, please reload the page")
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
