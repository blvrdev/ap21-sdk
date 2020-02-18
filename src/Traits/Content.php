<?php

namespace Omneo\Apparel21\Traits;

trait Content
{
    /**
     * Code.
     *
     * @var string
     */
    protected $code;

    /**
     * Color.
     *
     * @var string
     */
    protected $color;

    /**
     * Size.
     *
     * @var string
     */
    protected $size;

    /**
     * SKU ID.
     *
     * @var int
     */
    protected $skuId;

    /**
     * Quantity.
     *
     * @var int
     */
    protected $quantity;

    /**
     * Get code.
     *
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Set code.
     *
     * @param  string $code
     * @return static
     */
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * Get color.
     *
     * @return string
     */
    public function getColor()
    {
        return $this->color;
    }

    /**
     * Set color.
     *
     * @param  string $color
     * @return static
     */
    public function setColor($color)
    {
        $this->color = $color;

        return $this;
    }

    /**
     * Get size.
     *
     * @return string
     */
    public function getSize()
    {
        return $this->size;
    }

    /**
     * Set size.
     *
     * @param  string $size
     * @return static
     */
    public function setSize($size)
    {
        $this->size = $size;

        return $this;
    }

    /**
     * Get sku ID.
     *
     * @return int
     */
    public function getSkuId()
    {
        return $this->skuId;
    }

    /**
     * Set sku ID.
     *
     * @param  int $skuId
     * @return static
     */
    public function setSkuId($skuId)
    {
        $this->skuId = $skuId;

        return $this;
    }

    /**
     * Get quantity.
     *
     * @return int
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * Set quantity.
     *
     * @param  int $quantity
     * @return static
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;

        return $this;
    }
}