<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\User;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Component\Uid\Uuid;

/**
 * UserRepository class
 * @package App\Repository
 * @method findOneByEmail(string $email): ?User
 */
class UserRepository extends ServiceEntityRepository
{

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, User::class);
    }

    /**
     * Undocumented function
     *
     * @param Uuid $token
     * @return User|null
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function getUserByForgottenPasswordToken(Uuid $token): ?User
    {
        return $this->createQueryBuilder("u")
            ->where("u.forgottenPassword.token = :token")
            ->setParameter("token", $token)
            ->getQuery()
            ->getOneOrNullResult();
    }
}
