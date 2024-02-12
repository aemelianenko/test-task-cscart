<?php

declare(strict_types=1);

namespace Shop;

final class Shop
{
    /**
     * Quality max value.
     */
    const QUALITY_MAX = 50;

    /**
     * Quality min value.
     */
    const QUALITY_MIN = 0;

    /**
     * Mjolnir constant qualinty value.
     */
    const MJOLNIR_QUALITY = 80;

    /**
     * Mjolnir product name.
     */
    const MJOLNIR = 'Mjolnir';

    /**
     * Blue cheese product name.
     */
    const BLUE_CHEESE = 'Blue cheese';

    /**
     * Concert tickets product name.
     */
    const CONCERT_TICKETS = 'Concert tickets';

    /**
     * Magic cake product name.
     */
    const MAGIC_CAKE = 'Magic cake';

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
            if ($item->name == self::MJOLNIR) {
                $item = self::updateMjolnirQuality($item);
                continue;
            } elseif ($item->name == self::BLUE_CHEESE) {
                $item = self::updateBlueCheeseQuality($item);
            } elseif ($item->name == self::CONCERT_TICKETS) {
                $item = self::updateConcertTicketsQuality($item);
            } elseif ($item->name == self::MAGIC_CAKE) {
                $item = self::updateMagicCakeQuality($item);
            } else {
                $item = self::updateClassicQuality($item);
            }

            $item->quality = self::checkQualityValue($item->quality);

            --$item->sell_in;
        }
    }

    /**
     * Update mjolnir product quality param.
     *
     * @param  Item  $mjolnir  Mjolnir product data.
     */
    private static function updateMjolnirQuality(Item $mjolnir): Item
    {
        $mjolnir->quality = self::MJOLNIR_QUALITY;

        return $mjolnir;
    }

    /**
     * Update blue cheese quality param.
     *
     * @param  Item  $blue_cheese  Blue cheese product data.
     */
    private static function updateBlueCheeseQuality(Item $blue_cheese): Item
    {
        if ($blue_cheese->quality < self::QUALITY_MAX) {
            if ($blue_cheese->sell_in > 0) {
                ++$blue_cheese->quality;
            } elseif ($blue_cheese->sell_in <= 0) {
                $blue_cheese->quality += 2;
            }
        }

        return $blue_cheese;
    }

    /**
     * Update magic cake quality param.
     *
     * @param  Item  $magic_cake  Magic cake product data.
     */
    private function updateMagicCakeQuality(Item $magic_cake): Item
    {
        if ($magic_cake->quality > self::QUALITY_MIN) {
            if ($magic_cake->sell_in > 0) {
                $magic_cake->quality -= 2;
            } else {
                $magic_cake->quality -= 4;
            }
        }

        return $magic_cake;
    }

    /**
     * Update classic product quality param.
     *
     * @param  Item  $product  Data of classic product.
     */
    private static function updateClassicQuality(Item $product): Item
    {
        if ($product->quality > self::QUALITY_MIN) {
            if ($product->sell_in > 0) {
                --$product->quality;
            } else {
                $product->quality -= 2;
            }
        }

        return $product;
    }

    /**
     * Update concert tickets quality param.
     *
     * @param  Item  $concert_tickets  Concert ticket product data.
     */
    private static function updateConcertTicketsQuality(Item $concert_tickets): Item
    {
        if ($concert_tickets->sell_in <= 0) {
            $concert_tickets->quality = self::QUALITY_MIN;
        } elseif ($concert_tickets->sell_in <= 5 && $concert_tickets->quality < self::QUALITY_MAX) {
            $concert_tickets->quality += 3;
        } elseif ($concert_tickets->sell_in <= 10 && $concert_tickets->quality < self::QUALITY_MAX) {
            $concert_tickets->quality += 2;
        } else {
            ++$concert_tickets->quality;
        }

        return $concert_tickets;
    }

    /**
     * Checks the final quality value depending of allowable values.
     *
     * @param  int  $quality  Quality value.
     */
    private static function checkQualityValue(int $quality): int
    {
        if ($quality > self::QUALITY_MAX) {
            $quality = self::QUALITY_MAX;
        } elseif ($quality < self::QUALITY_MIN) {
            $quality = self::QUALITY_MIN;
        }

        return $quality;
    }
}