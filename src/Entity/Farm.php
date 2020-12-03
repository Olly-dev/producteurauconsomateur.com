<?php

declare(strict_types=1);

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Uid\Uuid;
use Symfony\Component\Validator\Constraints as Assert;

/**
 *  class Farm
 * @package App\Entity
 * @ORM\Entity
 */
class Farm
{
    /**
     * @ORM\Id
     * @ORM\Column(type="uuid")
     */
    private Uuid $id;

    /**
     * @ORM\Column(nullable=true)
     * @Assert\NotBlank
     */
    private ?string $name = null;

    /**
     * @ORM\Column(nullable=true, type="text")
     * @Assert\NotBlank
     */
    private ?string $description = null;

    /**
     * @ORM\OneToOne(targetEntity="Producer", mappedBy="farm")
     * @ORM\JoinColumn(onDelete="CASCADE")
     */
    private Producer $producer;

    /**
     * @ORM\Embedded(class="Address")
     * @Assert\Valid
     */
    private ?Address $address = null;

    /**
     *
     * @return Uuid
     */
    public function getId(): Uuid
    {
        return $this->id;
    }

    /**
     * @param Uuid $id
     * @return self
     */
    public function setId(Uuid $id): self
    {
        $this->id = $id;

        return $this;
    }

    /**
     *
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     *
     * @param string|null $name
     * @return self
     */
    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     *
     * @return string|null
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @param string|null $description
     * @return self
     */
    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Producer
     */
    public function getProducer(): Producer
    {
        return $this->producer;
    }

    /**
     * @param Producer $producer
     * @return self
     */
    public function setProducer(Producer $producer): self
    {
        $this->producer = $producer;

        return $this;
    }

    /**
     *
     * @return Address|null
     */ 
    public function getAddress(): ?Address
    {
        return $this->address;
    }

    /**
     *
     * @param Address|null $address
     * @return void
     */
    public function setAddress(?Address $address): self
    {
        $this->address = $address;

        return $this;
    }
}
