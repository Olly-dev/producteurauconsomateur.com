<?php

declare(strict_types=1);

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 *  class Producer
 * @package App\Entity
 * @ORM\Entity
 */
class Producer extends User
{
    public const ROLE = "producer";

    public function getRoles(): array
    {
        return ['ROLE_PRODUCER'];
    }
}