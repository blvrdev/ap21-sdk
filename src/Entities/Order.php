<?php

namespace Omneo\Apparel21\Entities;

use Omneo\Apparel21\Traits;
use Omneo\Apparel21\Contracts;

class Order implements Contracts\Order, Contracts\Identifiable
{
    use Traits\Order, Traits\Identifiable;

    /**
     * Freight option.
     *
     * @var FreightOption
     */
    protected $freightOption;

    /**
     * @var integer
     */
    protected $totalDiscount;

    /**
     * @var bool
     */
    protected $pricesIncludeTax;

    /**
     * Get freight option.
     *
     * @return FreightOption
     */
    public function getFreightOption()
    {
        return $this->freightOption;
    }

    /**
     * Set freight option.
     *
     * @param  FreightOption $freightOption
     * @return static
     */
    public function setFreightOption(FreightOption $freightOption)
    {
        $this->freightOption = $freightOption;

        return $this;
    }

    /**
     * @return integer
     */
    public function getTotalDiscount()
    {
        return $this->totalDiscount;
    }

    /**
     * Set the total discount for order
     *
     * @param integer $totalDiscount
     * @return static
     */
    public function setTotalDiscount($totalDiscount)
    {
        $this->totalDiscount = $totalDiscount;

        return $this;
    }

    /**
     * @return bool
     */
    public function getPricesIncludeTax()
    {
        return $this->pricesIncludeTax;
    }

    /**
     * Set whether prices include tax
     *
     * @param bool $pricesIncludeTax
     * @return static
     */
    public function setPricesIncludeTax($pricesIncludeTax)
    {
        $this->pricesIncludeTax = $pricesIncludeTax;

        return $this;
    }
}
