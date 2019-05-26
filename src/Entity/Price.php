<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PriceRepository")
 */
class Price
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $regular;

    /**
     * @ORM\Column(type="integer")
     */
    private $child;

    /**
     * @ORM\Column(type="integer")
     */
    private $senior;

    /**
     * @ORM\Column(type="integer")
     */
    private $discount;

    /**
     * @ORM\Column(type="integer")
     */
    private $free;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRegular(): ?int
    {
        return $this->regular;
    }

    public function setRegular(int $regular): self
    {
        $this->regular = $regular;

        return $this;
    }

    public function getChild(): ?int
    {
        return $this->child;
    }

    public function setChild(int $child): self
    {
        $this->child = $child;

        return $this;
    }

    public function getSenior(): ?int
    {
        return $this->senior;
    }

    public function setSenior(int $senior): self
    {
        $this->senior = $senior;

        return $this;
    }

    public function getDiscount(): ?int
    {
        return $this->discount;
    }

    public function setDiscount(int $discount): self
    {
        $this->discount = $discount;

        return $this;
    }

    public function getFree(): ?int
    {
        return $this->free;
    }

    public function setFree(int $free): self
    {
        $this->free = $free;

        return $this;
    }
}
