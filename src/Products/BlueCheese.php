<?php

declare(strict_types=1);

namespace Shop\Products;

use Shop\Item;

/**
 * Class BlueCheese.
 *
 * @package Shop\Products
 */
class BlueCheese implements ProductsInterface
{
    /**
     * Max value of blue cheese quality.
     *
     * @var int
     */
    const MAX_QUALITY = 50;

    /**
     * {@inheritDoc}
     */
    public function updateProductQuality(Item $blue_cheese): void
    {
        if ($blue_cheese->quality < self::MAX_QUALITY) {
            if ($blue_cheese->sell_in > 0) {
                ++$blue_cheese->quality;
            } elseif ($blue_cheese->sell_in <= 0) {
                $blue_cheese->quality += 2;
            }

            $this->validQuality($blue_cheese);
        }
    }

    /**
     * Checks quality result value.
     *
     * @param Item $item
     */
    private function validQuality(Item $blue_cheese): void
    {
        if ($blue_cheese->quality > self::MAX_QUALITY) {
            $blue_cheese->quality = self::MAX_QUALITY;
        }
    }

    /**
     * {@inheritDoc}
     */
    public function updateProductSellIn(Item $blue_cheese): void
    {
       --$blue_cheese->sell_in;
    }
}