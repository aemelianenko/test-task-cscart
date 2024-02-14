<?php

declare(strict_types=1);

namespace Shop\Products;

use Shop\Item;

/**
 * Class ConcertTickets.
 *
 * @package Shop\Products
 */
class ConcertTickets implements ProductsInterface
{
    /**
     * Max value of concert tickets quality.
     *
     * @var int
     */
    const MAX_QUALITY = 50;

    /**
     * Min value of concert tickets quality.
     *
     * @var int
     */
    const MIN_QUALITY = 0;

    /**
     * {@inheritDoc}
     */
    public function updateProductQuality(Item $concert_tickets): void
    {
        if ($concert_tickets->sell_in <= 0) {
            $concert_tickets->quality = self::MIN_QUALITY;
        } elseif ($concert_tickets->sell_in <= 5 && $concert_tickets->quality < self::MAX_QUALITY) {
            $concert_tickets->quality += 3;
        } elseif ($concert_tickets->sell_in <= 10 && $concert_tickets->quality < self::MAX_QUALITY) {
            $concert_tickets->quality += 2;
        } else {
            ++$concert_tickets->quality;
        }

        $this->validQuality($concert_tickets);
    }

    /**
     * Checks quality result value.
     *
     * @param  Item  $item
     */
    private function validQuality(Item $concert_tickets): void
    {
        if ($concert_tickets->quality > self::MAX_QUALITY) {
            $concert_tickets->quality = self::MAX_QUALITY;
        }
    }

    /**
     * {@inheritDoc}
     */
    public function updateProductSellIn(Item $concert_tickets): void
    {
        --$concert_tickets->sell_in;
    }
}