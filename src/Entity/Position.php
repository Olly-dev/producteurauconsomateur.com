<?php

declare(strict_types=1);

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 *  class Position
 * @package App\Entity
 * @ORM\Embeddable
 */
class Position
{
    /**
     * @ORM\Column(type="decimal", precision=16, scale=13, nullable=true)
     * @Assert\NotBlank
     * @Groups({"read"})
     */
    private ?float $latitude = null;

    /**
     * @ORM\Column(type="decimal", precision=16, scale=13, nullable=true)
     * @Assert\NotBlank
     * @Groups({"read"})
     */
    private ?float $longitude = null;


    /**
     * Undocumented function
     *
     * @return float|null
     */
    public function getLatitude(): ?float
    {
        return $this->latitude;
    }

    /**
     * Undocumented function
     *
     * @param float|null $latitude
     * @return self
     */
    public function setLatitude(?float $latitude): self
    {
        $this->latitude = $latitude;

        return $this;
    }

    /**
     * Undocumented function
     *
     * @return float|null
     */
    public function getLongitude(): ?float
    {
        return $this->longitude;
    }

    /**
     * Undocumented function
     *
     * @param float|null $longitude
     * @return self
     */
    public function setLongitude(?float $longitude): self
    {
        $this->longitude = $longitude;

        return $this;
    }
}
