<?php

declare(strict_types=1);

namespace App\EntityListener;

use App\Entity\Product;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Uid\Uuid;

/**
 *  class ProductListener
 * @package App\EntityListener
 */
class ProductListener
{
    /**
     * @var Security $security
     */
    private Security $security;

    /**
     * ProductListener constructor
     *
     * @param Security $security
     */
    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    /**
     * Undocumented function
     *
     * @param Product $product
     * @return void
     */
    public function prePersist(Product $product): void
    {
        if ($product->getFarm() !== null) {
            return;
        }
        $product->setFarm($this->security->getUser()->getFarm());
    }
}
