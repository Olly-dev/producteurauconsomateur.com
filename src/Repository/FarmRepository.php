<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\Farm;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * FarmRepository class
 * @package App\Repository
 * @method findByFarm(Farm $farm): array<Farm>
 */
class FarmRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Farm::class);
    }
}
