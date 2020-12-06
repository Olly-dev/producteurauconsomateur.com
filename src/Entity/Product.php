<?php

declare(strict_types=1);

namespace App\Entity;

use Symfony\Component\Uid\Uuid;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 *  class Product
 * @package App\Entity
 * @ORM\Entity
 * @ORM\EntityListeners({"App\EntityListener\ProductListener"})
 */
class Product
{
    /**
     * @ORM\Id
     * @ORM\Column(type="uuid")
     */
    private Uuid $id;

    /**
     * @ORM\Column
     * @Assert\NotBlank
     */
    private string $name = "";

    /**
     * @ORM\Column(type="text")
     * @Assert\NotBlank
     */
    private string $description = "";

    /**
     * @var int
     * @ORM\Column(type="integer")
     * @Assert\NotBlank
     * @Assert\GreaterThanOrEqual(0)
     */
    private int $quantity = 0;

    /**
     * @ORM\ManyToOne(targetEntity="Farm")
     * @ORM\JoinColumn(onDelete="CASCADE", nullable=false)
     */
    private Farm $farm;

    /**
     * @ORM\Embedded(class="Price")
     * @Assert\Valid
     */
    private Price $price;

    /**
     * Get the value of id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of name
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the value of name
     *
     * @return  self
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get the value of description
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set the value of description
     *
     * @return  self
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get the value of quantity
     *
     * @return  int
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * Set the value of quantity
     *
     * @param  int  $quantity
     *
     * @return  self
     */
    public function setQuantity(int $quantity)
    {
        $this->quantity = $quantity;

        return $this;
    }

    /**
     * Get the value of farm
     */
    public function getFarm()
    {
        return $this->farm;
    }

    /**
     * Set the value of farm
     *
     * @return  self
     */
    public function setFarm($farm)
    {
        $this->farm = $farm;

        return $this;
    }

    /**
     * Get the value of price
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set the value of price
     *
     * @return  self
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Undocumented function
     *
     * @return float
     */
    public function priceIncludingTaxes(): float
    {
        return ($this->price->getUnitPrice() * $this->price->getVat()) / 100;
    }
}
