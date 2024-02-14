<?php

declare(strict_types=1);

namespace Shop\Products;

use Shop\Item;

/**
 * Interface ProductsInterface.
 *
 * @package Shop\Products
 */
interface ProductsInterface
{
    /**
     * Update product quality.
     *
     * @param Item $item
     */
    public function updateProductQuality(Item $item): void;

    /**
     * Update product sell_in param.
     *
     * @param Item $item
     */
    public function updateProductSellIn(Item $item): void;
}