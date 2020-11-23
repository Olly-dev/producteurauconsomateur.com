<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\User;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

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
}
