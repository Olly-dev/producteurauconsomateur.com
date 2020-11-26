<?php

declare(strict_types=1);

namespace App\EntityListener;

use App\Entity\Farm;
use App\Entity\Producer;
use Symfony\Component\Uid\Uuid;

/**
 *  class ProducerListener
 * @package App\EntityListener
 */
class ProducerListener
{
    /**
     * Undocumented function
     *
     * @param Producer $producer
     * @return void
     */
    public function prePersist(Producer $producer): void
    {

        $farm = new Farm();
        $farm->setId(Uuid::v4());
        $farm->setProducer($producer);
        $producer->setFarm($farm);
    }
}
