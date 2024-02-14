<?php

declare(strict_types=1);

namespace Shop;

final class Shop
{
    /**
     * @var Item[]
     */
    private $items;

    /**
     * Shop constructor.
     *
     * @param Item[] $items
     */
    public function __construct(array $items)
    {
        $this->items = $items;
    }

    /**
     * Update products quality and sell_in values.
     */
    public function updateQuality(): void
    {
        foreach ($this->items as $item) {
            $class_name = str_replace(' ', '', ucwords($item->name));

            if (class_exists('Shop\Products\\' . $class_name)) {
                $class_name = 'Shop\Products\\' . $class_name;
                $product = new $class_name;
            } else {
                $product = new Products\ClassicProduct();
            }

            $product->updateProductQuality($item);
            $product->updateProductSellIn($item);
        }
    }
}