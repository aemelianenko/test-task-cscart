<?php

declare(strict_types=1);

namespace Shop\Products;

use Shop\Item;

/**
 * Class MagicCake.
 *
 * @package Shop\Products
 */
class MagicCake implements ProductsInterface
{
    /**
     * Min value of magic cake quality.
     *
     * @var int
     */
    const MIN_QUALITY = 0;

    /**
     * {@inheritDoc}
     */
    public function updateProductQuality(Item $magic_cake): void
    {
        if ($magic_cake->quality > self::MIN_QUALITY) {
            if ($magic_cake->sell_in > 0) {
                $magic_cake->quality -= 2;
            } else {
                $magic_cake->quality -= 4;
            }

            $this->validQuality($magic_cake);
        }
    }

    /**
     * Checks quality result value.
     *
     * @param  Item  $item
     */
    private function validQuality(Item $magic_cake): void
    {
        if ($magic_cake->quality < self::MIN_QUALITY) {
            $magic_cake->quality = self::MIN_QUALITY;
        }
    }

    /**
     * {@inheritDoc}
     */
    public function updateProductSellIn(Item $magic_cake): void
    {
        --$magic_cake->sell_in;
    }
}