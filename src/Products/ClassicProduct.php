<?php

declare(strict_types=1);

namespace Shop\Products;

use Shop\Item;

/**
 * Class ClassicProduct.
 *
 * @package Shop\Products
 */
class ClassicProduct implements ProductsInterface
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
    public function updateProductQuality(Item $product): void
    {
        if ($product->quality > self::MIN_QUALITY) {
            if ($product->sell_in > 0) {
                --$product->quality;
            } else {
                $product->quality -= 2;
            }

            $this->validQuality($product);
        }
    }

    /**
     * Checks quality result value.
     *
     * @param  Item  $item
     */
    private function validQuality(Item $product): void
    {
        if ($product->quality < self::MIN_QUALITY) {
            $product->quality = self::MIN_QUALITY;
        }
    }

    /**
     * {@inheritDoc}
     */
    public function updateProductSellIn(Item $product): void
    {
        --$product->sell_in;
    }
}