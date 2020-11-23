<?php

declare(strict_types=1);

namespace App\Dto;

use App\Validator\EmailExists;
use Symfony\Component\Validator\Constraints as Assert;

/**
 *  class ForgottenPasswordInput
 * @package App\Dto
 */
class ForgottenPasswordInput
{
    /**
     * @Assert\NotBlank
     * @Assert\Email
     * @EmailExists
     */
    private string $email = "";

    /**
     * Get the value of email
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the value of email
     *
     * @return  self
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }
}
