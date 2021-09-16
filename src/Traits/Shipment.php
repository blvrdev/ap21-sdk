<?php

namespace Omneo\Apparel21\Traits;

use Carbon\Carbon;
use Illuminate\Support\Collection;

trait Shipment
{
    /**
     * Carrier name.
     *
     * @var string
     */
    protected $carrierName;

    /**
     * Carrier URL.
     *
     * @var string
     */
    protected $carrierUrl;

    /**
     * Tracking Code.
     *
     * @var string
     */
    protected $trackingCode;

    /**
     * Dispatch Date.
     *
     * @var Carbon
     */
    protected $dispatchDate;

    /**
     * Contents collection.
     *
     * @var Collection
     */
    protected $contents;

    /**
     * Return carrier name.
     *
     * @return string
     */
    public function getCarrierName()
    {
        return $this->carrierName;
    }

    /**
     * Set carrier name.
     *
     * @param  string $carrierName
     * @return static
     */
    public function setCarrierName($carrierName = null)
    {
        $this->carrierName = $carrierName;

        return $this;
    }

    /**
     * Return carrier URL.
     *
     * @return string
     */
    public function getCarrierUrl()
    {
        return $this->carrierUrl;
    }

    /**
     * Set carrier URL.
     *
     * @param  string $carrierUrl
     * @return static
     */
    public function setCarrierUrl($carrierUrl = null)
    {
        $this->carrierUrl = $carrierUrl;

        return $this;
    }

    /**
     * Return tracking code.
     *
     * @return string
     */
    public function getTrackingCode()
    {
        return $this->trackingCode;
    }

    /**
     * Set tracking code.
     *
     * @param  string $trackingCode
     * @return static
     */
    public function setTrackingCode($trackingCode = null)
    {
        $this->trackingCode = $trackingCode;

        return $this;
    }

    /**
     * Return dispatch date.
     *
     * @return Carbon
     */
    public function getDispatchDate()
    {
        return $this->dispatchDate;
    }

    /**
     * Set dispatch date.
     *
     * @param  Carbon $dispatchDate
     * @return static
     */
    public function setDispatchDate($dispatchDate = null)
    {
        $this->dispatchDate = $dispatchDate;

        return $this;
    }

    /**
     * Return contents collection.
     *
     * @return Collection
     */
    public function getContents()
    {
        return $this->contents ?: $this->contents = new Collection;
    }

    /**
     * Set contents collection.
     *
     * @param  Collection $contents
     * @return static
     */
    public function setContents(Collection $contents)
    {
        $this->contents = $contents;

        return $this;
    }
}