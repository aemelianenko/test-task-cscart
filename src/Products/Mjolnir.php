<?php

declare(strict_types=1);

namespace Shop\Products;

use Shop\Item;

/**
 * Class Mjolnir.
 *
 * @package Shop\Products
 */
class Mjolnir implements ProductsInterface
{
    /**
     * Max value of mjolnir quality.
     *
     * @var int
     */
    const MAX_QUALITY = 80;

    /**
     * {@inheritDoc}
     */
    public function updateProductQuality(Item $mjolnir): void
    {
        $mjolnir->quality = self::MAX_QUALITY;
    }

    /**
     * {@inheritDoc}
     */
    public function updateProductSellIn(Item $mjolnir): void
    {
        $mjolnir->sell_in = $mjolnir->sell_in;
    }
}