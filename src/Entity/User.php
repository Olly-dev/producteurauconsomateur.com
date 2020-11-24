<?php

declare(strict_types=1);

namespace App\Entity;

use DateTimeImmutable;
use Symfony\Component\Uid\Uuid;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping\Embedded;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 *  class User
 * @package App\Entity
 * @ORM\Entity
 * @ORM\InheritanceType("SINGLE_TABLE")
 * @ORM\DiscriminatorColumn(name="discr", type="string")
 * @ORM\DiscriminatorMap({"producer"="App\Entity\Producer", "customer"="App\Entity\Customer"})
 * @UniqueEntity("email")
 */
abstract class User implements UserInterface
{
    /**
     * @ORM\Id
     * @ORM\Column(type="uuid")
     */
    protected Uuid $id;

    /**
     * @ORM\Column
     * @Assert\NotBlank
     */
    protected string $firstName = "";

    /**
     * @ORM\Column
     * @Assert\NotBlank
     */
    protected string $lastName = "";

    /**
     * @ORM\Column(unique=true)
     * @Assert\NotBlank
     * @Assert\Email
     */
    protected string $email = "";

    /**
     * @ORM\Column
     */
    protected string $password = "";

    /**
     * @Assert\NotBlank
     *  @Assert\Length(min=8)
     */
    protected ?string $plainPassword = null;

    /**
     * @ORM\Column(type="datetime_immutable")
     */
    protected DateTimeImmutable $registredDate;

    /**
     * @ORM\Embedded(class="ForgottenPassword")
     */
    protected ?ForgottenPassword $forgottenPassword;

    /**
     * constructor
     */
    public function __construct()
    {
        $this->registredDate = new DateTimeImmutable();
    }

    /**
     * Get the value of plainPassword
     */
    public function getPlainPassword(): ?string
    {
        return $this->plainPassword;
    }

    /**
     * Set the value of plainPassword
     *
     * @return  self
     */
    public function setPlainPassword(?string $plainPassword): self
    {
        $this->plainPassword = $plainPassword;

        return $this;
    }

    /**
     * Get the value of registredDate
     */
    public function getRegistredDate(): DateTimeImmutable
    {
        return $this->registredDate;
    }

    /**
     * Set the value of registredDate
     *
     * @return  self
     */
    public function setRegistredDate(DateTimeImmutable $registredDate): self
    {
        $this->registredDate = $registredDate;

        return $this;
    }

    /**
     * Get the value of id
     */
    public function getId(): Uuid
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */
    public function setId(Uuid $id): self
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of firstName
     */
    public function getFirstName(): string
    {
        return $this->firstName;
    }

    /**
     * Set the value of firstName
     *
     * @return  self
     */
    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * Get the value of lastName
     */
    public function getLastName(): string
    {
        return $this->lastName;
    }

    /**
     * Set the value of lastName
     *
     * @return  self
     */
    public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * Get the value of email
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * Set the value of email
     *
     * @return  self
     */
    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get the value of password
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * Set the value of password
     *
     * @return  self
     */
    public function setPassword(string $password): self
    {
        $this->forgottenPassword = null;
        $this->password = $password;

        return $this;
    }

    public function getSalt()
    {
    }

    /**
     *
     * @return string
     */
    public function getUsername(): string
    {
        return $this->email;
    }

    public function eraseCredentials(): void
    {
        $this->plainPassword = null;
    }

    public function hasForgotHisPassword(): void
    {
        $this->forgottenPassword = new ForgottenPassword();
    }


    /**
     *
     * @return string
     */
    public function getFullName(): string
    {
        return sprintf("%s %s", $this->firstName, $this->lastName);
    }

    /**
     * @return ForgottenPassword|null
     */
    public function getForgottenPassword(): ?ForgottenPassword
    {
        return $this->forgottenPassword;
    }
}
