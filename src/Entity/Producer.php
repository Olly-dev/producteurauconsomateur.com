<?php

declare(strict_types=1);

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 *  class Producer
 * @package App\Entity
 * @ORM\Entity
 * @ORM\EntityListeners({"App\EntityListener\ProducerListener"})
 */
class Producer extends User
{
    public const ROLE = "producer";

    /**
     * @ORM\OneToOne(targetEntity="Farm", cascade={"persist"}, inversedBy="producer")
     */
    private Farm $farm;

    /**
     * Undocumented function
     *
     * @return array|string[]
     */
    public function getRoles(): array
    {
        return ['ROLE_PRODUCER'];
    }

    /**
     * @return Farm
     */
    public function getFarm(): Farm
    {
        return $this->farm;
    }

   /**
    * @param Farm $farm
    * @return self
    */
    public function setFarm(Farm $farm): self
    {
        $this->farm = $farm;

        return $this;
    }
}
