<?php

declare(strict_types=1);

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 *  class Address
 * @package App\Entity
 * @ORM\Embeddable
 */
class Address
{
    /**
     * @ORM\Column(nullable=true)
     * @Assert\NotBlank
     */
    private ?string $address = null;

    /**
     * @ORM\Column(nullable=true)
     */
    private ?string $restAddress = null;

    /**
     * @ORM\Column(length=5, nullable=true)
     * @Assert\NotBlank
     * @Assert\Regex(pattern="/^[A-Za-z0-9]{5}$/")
     */
    private ?string $zipCode = null;

    /**
     * @ORM\Column(nullable=true)
     * @Assert\NotBlank
     */
    private ?string $city = null;

    /**
     * @ORM\Embedded(class="Position")
     * @Assert\Valid
     */
    private ?Position $position = null;



    /**
     * Get the value of address
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Set the value of address
     *
     * @return  self
     */
    public function setAddress($address)
    {
        $this->address = $address;

        return $this;
    }

    /**
     * Get the value of restAddress
     */
    public function getRestAddress()
    {
        return $this->restAddress;
    }

    /**
     * Set the value of restAddress
     *
     * @return  self
     */
    public function setRestAddress($restAddress)
    {
        $this->restAddress = $restAddress;

        return $this;
    }

    /**
     * Get the value of zipCode
     */
    public function getZipCode()
    {
        return $this->zipCode;
    }

    /**
     * Set the value of zipCode
     *
     * @return  self
     */
    public function setZipCode($zipCode)
    {
        $this->zipCode = $zipCode;

        return $this;
    }

    /**
     * Get the value of city
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Set the value of city
     *
     * @return  self
     */
    public function setCity($city)
    {
        $this->city = $city;

        return $this;
    }

    /**
     * Get the value of position
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * Set the value of position
     *
     * @return  self
     */
    public function setPosition($position)
    {
        $this->position = $position;

        return $this;
    }
}
