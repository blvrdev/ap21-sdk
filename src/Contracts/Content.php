<?php

namespace Omneo\Apparel21\Contracts;

interface Content
{
    /**
     * Get code.
     *
     * @return string
     */
    public function getCode();

    /**
     * Set code.
     *
     * @param  string $code
     * @return static
     */
    public function setCode($code);

    /**
     * Get color.
     *
     * @return string
     */
    public function getColor();

    /**
     * Set color.
     *
     * @param  string $color
     * @return static
     */
    public function setColor($color);

    /**
     * Get size.
     *
     * @return string
     */
    public function getSize();

    /**
     * Set size.
     *
     * @param  string $size
     * @return static
     */
    public function setSize($size);

    /**
     * Get SKU ID.
     *
     * @return int
     */
    public function getSkuId();

    /**
     * Set SKU ID.
     *
     * @param  int $skuId
     * @return static
     */
    public function setSkuId($skuId);

    /**
     * Get quantity.
     *
     * @return int
     */
    public function getQuantity();

    /**
     * Set quantity.
     *
     * @param  int $quantity
     * @return static
     */
    public function setQuantity($quantity);
}