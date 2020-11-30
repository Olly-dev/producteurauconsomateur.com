<?php

declare(strict_types=1);

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Uid\Uuid;
use Symfony\Component\Validator\Constraints as Assert;

/**
 *  class Price
 * @package App\Entity
 * @ORM\Embeddable
 */
class Price
{
    /**
     * @ORM\Column(type="integer")
     * @Assert\NotBlank
     * @Assert\GreaterThan(0)
     */
    private int $unitPrice = 0;

    /**
     * @ORM\Column(type="decimal", precision=5, scale=2)
     * @Assert\NotBlank
     */
    private float $vat = 0;


    /**
     * Get the value of unitPrice
     */
    public function getUnitPrice()
    {
        return $this->unitPrice;
    }

    /**
     * Set the value of unitPrice
     *
     * @return  self
     */
    public function setUnitPrice($unitPrice)
    {
        $this->unitPrice = $unitPrice;

        return $this;
    }

    /**
     * Get the value of vat
     */
    public function getVat()
    {
        return $this->vat;
    }

    /**
     * Set the value of vat
     *
     * @return  self
     */
    public function setVat($vat)
    {
        $this->vat = $vat;

        return $this;
    }
}
