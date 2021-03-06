<?php

namespace App\DataFixtures;

use App\Entity\Customer;
use App\Entity\Producer;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Uid\Uuid;

/**
 * class UserFixtures
 * @package App\DataFixtures
 */
class UserFixtures extends Fixture
{
    /**
     * @var UserPasswordEncoderInterface
     */
    private UserPasswordEncoderInterface $userPasswordEncoder;

    public function __construct(UserPasswordEncoderInterface $userPasswordEncoder)
    {
        $this->userPasswordEncoder = $userPasswordEncoder;
    }

    public function load(ObjectManager $manager)
    {
        $producer = new Producer();
        $producer->setId(Uuid::v4());
        $producer->setPassword($this->userPasswordEncoder->encodePassword($producer, "password"));
        $producer->setFirstName("Jane");
        $producer->setLastName("Doe");
        $producer->setEmail("producer@email.com");
        $manager->persist($producer);

        $customer = new Customer();
        $customer->setId(Uuid::v4());
        $customer->setPassword($this->userPasswordEncoder->encodePassword($customer, "password"));
        $customer->setFirstName("John");
        $customer->setLastName("Doe");
        $customer->setEmail("customer@email.com");
        $manager->persist($customer);

        $manager->flush();
    }
}
