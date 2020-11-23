<?php

namespace App\Entity;

use DateTimeImmutable;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Uid\Uuid;

/**
 *  class ForgottenPassword
 * @package App\Entity
 * @ORM\Embeddable
 */
class ForgottenPassword
{
    /**
     * @ORM\Column(type="uuid", unique=true, nullable=true)
     */
    private ?string $token = null;

    /**
     * @ORM\Column(type="datetime_immutable", nullable=true)
     */
    private ?DateTimeImmutable $requestedAt = null;

    /**
     * class ForgottenPassword constructor
     */
    public function __construct()
    {
        $this->token = Uuid::v4();
        $this->requestedAt = new DateTimeImmutable();
    }



    /**
     * @return DateTimeImmutable|null
     */
    public function getRequestedAt(): ?DateTimeImmutable
    {
        return $this->requestedAt;
    }

    /**
     * @param DateTimeImmutable|null $requestedAt
     * @return void
     */
    public function setRequestedAt(?DateTimeImmutable $requestedAt): self
    {
        $this->requestedAt = $requestedAt;

        return $this;
    }

    /**
     * @return string|\Symfony\Component\Uid\UuidV4|null
     */
    public function getToken()
    {
        return $this->token;
    }

    /**
     * @param string|\Symfony\Component\Uid\UuidV4|null $token
     * @return self
     */
    public function setToken($token): self
    {
        $this->token = $token;

        return $this;
    }
}
