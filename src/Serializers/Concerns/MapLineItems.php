<?php

namespace Arkade\Apparel21\Serializers\Concerns;

use Arkade\Apparel21\Entities;
use Illuminate\Support\Collection;

trait MapLineItems
{
    /**
     * Map line items to given payload array.
     *
     * @param  array      $payload
     * @param  Collection $lineItems
     * @return array
     */
    protected function mapLineItems(array $payload, Collection $lineItems)
    {
        array_set($payload, 'OrderDetails', []);

        $lineItems->each(function (Entities\LineItem $lineItem) use (&$payload) {
            array_push($payload['OrderDetails'], $this->serializeLineItem($lineItem));
        });

        return $payload;
    }

    /**
     * Serialize given line item.
     *
     * @param  Entities\LineItem $lineItem
     * @return array
     */
    protected function serializeLineItem(Entities\LineItem $lineItem)
    {
        return array_filter([
            '@node'     => 'OrderDetail',
            'SkuId'     => $lineItem->getSellable()->getIdentifiers()->get('ap21_sku_id'),
            'ProductId' => $lineItem->getSellable()->getIdentifiers()->get('ap21_product_id'),
            'Price'     => $lineItem->getSellable()->getPrice() / 100,
            'Quantity'  => $lineItem->getQuantity(),
            'Value'     => $lineItem->getTotal() / 100,
            'Discounts' => [
                'Discount' => $lineItem->getDiscount()->map(function($item, $value) {
                    if ($value === 'Value') {
                        $item = $item /100;
                    }
                    return $item;
                })->toArray()
            ]
        ]);
    }
}
